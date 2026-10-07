<?php

namespace App\Licensing;

/**
 * EduCore license guard.
 *
 * Copyright (c) Sopheara Seth. All rights reserved.
 *
 * This project is the author's own work. Running it requires a license file
 * issued by the author. Removing, disabling or bypassing this check, or
 * replacing the public key below, is not permitted without the author's
 * written permission.
 *
 * How it works: a license is a small JSON payload (who it is for, when it
 * expires) signed with the author's private Ed25519 key. The private key never
 * enters this repository, so nobody else can create or extend a license.
 */
class License
{
    /**
     * Author's public key (base64). Empty means the check is not set up yet.
     * Filled in by `php artisan license:keygen`.
     */
    public const PUBLIC_KEY = 'Ve6m1Cm8y8DUEekdSgAeit/b5OIPz6/Ne/P8iQQahcg=';

    public const APP = 'edu-core';

    public const OWNER = 'Sopheara';

    /** Where a copy of the project keeps its license (ignored by git). */
    public static function path(): string
    {
        return storage_path('license.key');
    }

    /** Where the author's private signing key lives: outside the project, never in git. */
    public static function ownerKeyPath(): ?string
    {
        $home = getenv('USERPROFILE') ?: getenv('HOME');

        return $home
            ? $home . DIRECTORY_SEPARATOR . '.edu-core' . DIRECTORY_SEPARATOR . 'license-private.key'
            : null;
    }

    public static function isEnforced(): bool
    {
        return self::PUBLIC_KEY !== '';
    }

    /**
     * @return array{ok: bool, state: string, message: string, holder: ?string, expires_at: ?int}
     */
    public static function status(): array
    {
        if (! self::isEnforced()) {
            return self::result(true, 'disabled', 'The license check is not set up yet.');
        }

        if (! function_exists('sodium_crypto_sign_verify_detached')) {
            return self::result(false, 'no_sodium', 'The PHP "sodium" extension is needed to read the license. Enable extension=sodium in php.ini.');
        }

        if (! is_file(self::path())) {
            return self::result(false, 'missing', 'No license found for this copy of the project.');
        }

        $data = self::verify((string) file_get_contents(self::path()));

        if ($data === null) {
            return self::result(false, 'invalid', 'The license file is not valid for this project.');
        }

        $holder = isset($data['name']) ? (string) $data['name'] : null;
        $expiresAt = isset($data['exp']) ? (int) $data['exp'] : null;

        if ($expiresAt !== null && self::now() > $expiresAt) {
            return self::result(false, 'expired', 'The license expired on ' . date('Y-m-d H:i T', $expiresAt) . '.', $holder, $expiresAt);
        }

        return self::result(true, 'valid', 'Licensed.', $holder, $expiresAt);
    }

    /** Check a license string against the public key. Returns its payload, or null if it is not genuine. */
    public static function verify(string $license): ?array
    {
        $parts = explode('.', trim($license));
        $publicKey = base64_decode(self::PUBLIC_KEY, true);

        if (count($parts) !== 2 || $publicKey === false) {
            return null;
        }

        $payload = self::decode($parts[0]);
        $signature = self::decode($parts[1]);

        if ($payload === null || $signature === null) {
            return null;
        }

        try {
            if (! sodium_crypto_sign_verify_detached($signature, $payload, $publicKey)) {
                return null;
            }
        } catch (\Throwable) {
            return null;
        }

        $data = json_decode($payload, true);

        return is_array($data) && ($data['app'] ?? null) === self::APP ? $data : null;
    }

    /** Create a license string. Only possible with the author's private key. */
    public static function sign(string $name, ?int $expiresAt, string $secretKey): string
    {
        $payload = json_encode([
            'app' => self::APP,
            'name' => $name,
            'iat' => time(),
            'exp' => $expiresAt,
        ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

        return self::encode($payload) . '.' . self::encode(sodium_crypto_sign_detached($payload, $secretKey));
    }

    /** Short text for the terminal. */
    public static function consoleMessage(array $status): string
    {
        return PHP_EOL
            . '  LICENSE REQUIRED' . PHP_EOL
            . '  ' . $status['message'] . PHP_EOL
            . '  Ask ' . self::OWNER . ' for a license, then run:' . PHP_EOL
            . '      php artisan license:install <license>' . PHP_EOL
            . PHP_EOL;
    }

    /** Standalone page for the browser (no layout, no database). */
    public static function htmlMessage(array $status): string
    {
        $message = htmlspecialchars($status['message'], ENT_QUOTES, 'UTF-8');
        $owner = htmlspecialchars(self::OWNER, ENT_QUOTES, 'UTF-8');

        return <<<HTML
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>License required</title>
<style>
body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;background:#f5f6fa;color:#1e1e2f;font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif}
main{max-width:520px;margin:24px;padding:36px 40px;background:#fff;border-radius:10px;box-shadow:0 2px 10px rgba(30,30,47,.1)}
h1{margin:0 0 12px;font-size:24px}
p{margin:0 0 12px;line-height:1.6;color:#55556a}
code{display:block;margin-top:6px;padding:10px 12px;background:#efeff8;border-radius:6px;font-size:14px;color:#1e1e2f}
</style>
</head>
<body>
<main>
<h1>License required</h1>
<p>{$message}</p>
<p>Ask {$owner} for a license, then run this in the project folder:
<code>php artisan license:install &lt;license&gt;</code></p>
</main>
</body>
</html>
HTML;
    }

    private static function result(bool $ok, string $state, string $message, ?string $holder = null, ?int $expiresAt = null): array
    {
        return ['ok' => $ok, 'state' => $state, 'message' => $message, 'holder' => $holder, 'expires_at' => $expiresAt];
    }

    /**
     * Current time, but never earlier than the latest time this copy has already
     * seen, so setting the computer clock back does not revive an expired license.
     */
    private static function now(): int
    {
        $now = time();
        $file = storage_path('framework/cache/license.clock');
        $seen = is_file($file) ? (int) @file_get_contents($file) : 0;

        if ($now > $seen + 300) {
            @file_put_contents($file, (string) $now, LOCK_EX);
        }

        return max($now, $seen);
    }

    private static function encode(string $bytes): string
    {
        return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '=');
    }

    private static function decode(string $text): ?string
    {
        $bytes = base64_decode(strtr($text, '-_', '+/'), true);

        return $bytes === false ? null : $bytes;
    }
}
