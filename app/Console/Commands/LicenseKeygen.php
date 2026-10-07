<?php

namespace App\Console\Commands;

use App\Licensing\License;
use Illuminate\Console\Command;

class LicenseKeygen extends Command
{
    protected $signature = 'license:keygen
        {--force : Replace the existing key pair. Every license issued so far stops working}';

    protected $description = 'Owner only, run once: create the signing key pair and switch the license check on';

    public function handle(): int
    {
        if (! function_exists('sodium_crypto_sign_keypair')) {
            $this->error('The PHP "sodium" extension is required. Enable extension=sodium in php.ini.');

            return self::FAILURE;
        }

        if (License::isEnforced() && ! $this->option('force')) {
            $this->error('The license check is already set up. Use --force to replace the key pair (all issued licenses stop working).');

            return self::FAILURE;
        }

        $keyPath = License::ownerKeyPath();

        if ($keyPath === null) {
            $this->error('Could not find your home folder to store the private key.');

            return self::FAILURE;
        }

        // Reuse an existing private key unless --force, so re-running never orphans issued licenses.
        if (is_file($keyPath) && ! $this->option('force')) {
            $secretKey = base64_decode(trim((string) file_get_contents($keyPath)), true);

            if ($secretKey === false || strlen($secretKey) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
                $this->error("The private key at {$keyPath} is damaged. Use --force to create a new one.");

                return self::FAILURE;
            }

            $this->line("Using your existing private key: {$keyPath}");
        } else {
            $secretKey = sodium_crypto_sign_secretkey(sodium_crypto_sign_keypair());

            if (! is_dir(dirname($keyPath))) {
                mkdir(dirname($keyPath), 0700, true);
            }

            if (file_put_contents($keyPath, base64_encode($secretKey)) === false) {
                $this->error("Could not write the private key to {$keyPath}.");

                return self::FAILURE;
            }

            @chmod($keyPath, 0600);
            $this->line("Private key saved: {$keyPath}");
        }

        $publicKey = base64_encode(sodium_crypto_sign_publickey_from_secretkey($secretKey));

        // Write the public key into the License class.
        $classFile = app_path('Licensing/License.php');
        $source = preg_replace(
            "/const PUBLIC_KEY = '[^']*';/",
            "const PUBLIC_KEY = '{$publicKey}';",
            (string) file_get_contents($classFile),
            1,
            $replaced
        );

        if ($replaced !== 1 || file_put_contents($classFile, $source) === false) {
            $this->error("Could not write the public key into {$classFile}.");

            return self::FAILURE;
        }

        // Your own copy: a license that never expires.
        file_put_contents(License::path(), License::sign(License::OWNER, null, $secretKey));

        $this->newLine();
        $this->info('License check is now ON for this project.');
        $this->line('  - Your own license (never expires) is installed in storage/license.key.');
        $this->line('  - Commit and push app/Licensing/License.php so the lock reaches your team.');
        $this->line('  - Back up your private key. Without it you cannot issue licenses.');
        $this->line('  - Give access with: php artisan license:issue <name> --days=2');

        return self::SUCCESS;
    }
}
