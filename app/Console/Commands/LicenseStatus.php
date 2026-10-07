<?php

namespace App\Console\Commands;

use App\Licensing\License;
use Illuminate\Console\Command;

class LicenseStatus extends Command
{
    protected $signature = 'license:status';

    protected $description = 'Show whether this copy of the project is licensed and until when';

    public function handle(): int
    {
        $status = License::status();

        if ($status['state'] === 'disabled') {
            $this->line($status['message']);

            return self::SUCCESS;
        }

        if ($status['holder'] !== null) {
            $this->line('Licensed to: ' . $status['holder']);
            $this->line('Expires:     ' . ($status['expires_at'] === null ? 'never' : date('Y-m-d H:i T', $status['expires_at'])));
        }

        if ($status['ok']) {
            $this->info('License is valid.');

            return self::SUCCESS;
        }

        $this->error($status['message']);

        return self::FAILURE;
    }
}
