<?php

namespace App\Console\Commands;

use App\Licensing\License;
use Illuminate\Console\Command;

class LicenseInstall extends Command
{
    protected $signature = 'license:install
        {license? : The license text you were given}
        {--file= : Read the license from a file instead}';

    protected $description = 'Install the license you were given so the project runs';

    public function handle(): int
    {
        if (! License::isEnforced()) {
            $this->info('This project does not need a license yet.');

            return self::SUCCESS;
        }

        if (! function_exists('sodium_crypto_sign_verify_detached')) {
            $this->error('The PHP "sodium" extension is required. Enable extension=sodium in php.ini.');

            return self::FAILURE;
        }

        $file = $this->option('file');

        if ($file !== null && ! is_file($file)) {
            $this->error("File not found: {$file}");

            return self::FAILURE;
        }

        $license = trim((string) ($file !== null ? file_get_contents($file) : $this->argument('license')));

        if ($license === '') {
            $this->error('Give the license text, or --file=path/to/license.key');

            return self::FAILURE;
        }

        if (License::verify($license) === null) {
            $this->error('That license is not valid for this project.');

            return self::FAILURE;
        }

        if (file_put_contents(License::path(), $license) === false) {
            $this->error('Could not write ' . License::path());

            return self::FAILURE;
        }

        return $this->call('license:status');
    }
}
