<?php

namespace App\Providers;

use App\Licensing\License;
use Illuminate\Support\ServiceProvider;

/**
 * Enforces the project license (see App\Licensing\License) for both the
 * website and artisan commands. Listed first in bootstrap/providers.php so it
 * runs before any provider that touches the database.
 */
class LicenseServiceProvider extends ServiceProvider
{
    /** Commands that must work without a license: the license tools and Composer's post-install step. */
    private const OPEN_COMMANDS = [
        'license:keygen',
        'license:issue',
        'license:install',
        'license:status',
        'package:discover',
    ];

    public function boot(): void
    {
        $status = License::status();

        if ($status['ok']) {
            return;
        }

        if ($this->app->runningInConsole()) {
            if (in_array($_SERVER['argv'][1] ?? '', self::OPEN_COMMANDS, true)) {
                return;
            }

            fwrite(STDERR, License::consoleMessage($status));
            exit(1);
        }

        // Web request: answer with the "License required" page and stop here,
        // before routes, sessions or the database are touched.
        http_response_code(403);
        header('Content-Type: text/html; charset=UTF-8');
        echo License::htmlMessage($status);
        exit;
    }
}
