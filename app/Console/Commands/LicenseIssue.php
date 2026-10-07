<?php

namespace App\Console\Commands;

use App\Licensing\License;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class LicenseIssue extends Command
{
    protected $signature = 'license:issue
        {name : Who the license is for}
        {--days=2 : Days until the license expires}
        {--hours= : Expire after this many hours instead of days}
        {--never : No expiry}
        {--install : Also install it into this copy of the project}';

    protected $description = 'Owner only: create a license for someone (needs your private key)';

    public function handle(): int
    {
        $keyPath = License::ownerKeyPath();

        if ($keyPath === null || ! is_file($keyPath)) {
            $this->error('Private key not found. Only the project owner can issue licenses.');

            return self::FAILURE;
        }

        if (! function_exists('sodium_crypto_sign_detached')) {
            $this->error('The PHP "sodium" extension is required. Enable extension=sodium in php.ini.');

            return self::FAILURE;
        }

        $secretKey = base64_decode(trim((string) file_get_contents($keyPath)), true);

        if ($secretKey === false || strlen($secretKey) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
            $this->error("The private key at {$keyPath} is damaged.");

            return self::FAILURE;
        }

        if ($this->option('never')) {
            $expiresAt = null;
        } else {
            $hours = $this->option('hours') !== null
                ? (float) $this->option('hours')
                : (float) $this->option('days') * 24;

            if ($hours <= 0) {
                $this->error('The expiry must be more than zero.');

                return self::FAILURE;
            }

            $expiresAt = time() + (int) round($hours * 3600);
        }

        $name = (string) $this->argument('name');
        $license = License::sign($name, $expiresAt, $secretKey);

        if (License::isEnforced() && License::verify($license) === null) {
            $this->error('This private key does not match the public key in app/Licensing/License.php.');

            return self::FAILURE;
        }

        // Keep a copy next to the private key, ready to send as a file.
        $copy = dirname($keyPath) . DIRECTORY_SEPARATOR . 'issued' . DIRECTORY_SEPARATOR . (Str::slug($name) ?: 'license') . '.key';

        if (! is_dir(dirname($copy))) {
            mkdir(dirname($copy), 0700, true);
        }

        file_put_contents($copy, $license);

        if ($this->option('install')) {
            file_put_contents(License::path(), $license);
        }

        $this->info("License for {$name}");
        $this->line('  Expires: ' . ($expiresAt === null ? 'never' : date('Y-m-d H:i T', $expiresAt)));
        $this->line("  Saved to: {$copy}");
        $this->newLine();
        $this->line('Send them this text. They run: php artisan license:install <text>');
        $this->newLine();
        $this->line($license);

        return self::SUCCESS;
    }
}
