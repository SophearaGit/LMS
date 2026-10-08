<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Guards the file manager routes: refuses any upload, rename or new folder whose
 * name would let the web server run it as code (shell.php, x.phtml, .htaccess ...).
 *
 * Needed because the file manager only checks the extension at upload time. A file
 * uploaded with no extension could afterwards be renamed to "something.php".
 */
class BlockDangerousFileNames
{
    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'pht', 'phps', 'phar',
        'html', 'htm', 'xhtml', 'shtml', 'htaccess', 'htpasswd', 'ini',
        'cgi', 'pl', 'py', 'sh', 'bash', 'asp', 'aspx', 'jsp', 'exe', 'bat', 'cmd', 'com',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $names = [];
        foreach (['new_name', 'name'] as $key) {
            if (is_string($request->input($key))) {
                $names[] = $request->input($key);
            }
        }
        $files = $request->allFiles();
        array_walk_recursive($files, function ($file) use (&$names) {
            $names[] = $file->getClientOriginalName();
        });
        foreach ($names as $name) {
            if (self::isDangerous($name)) {
                abort(403, 'This file name is not allowed.');
            }
        }
        return $next($request);
    }

    public static function isDangerous(string $name): bool
    {
        $name = strtolower(basename(str_replace('\\', '/', $name)));
        $name = rtrim($name, ". \t\n\r\0");
        if ($name === '') {
            return false;
        }
        // Hidden config files such as .htaccess or .user.ini
        if (str_starts_with($name, '.')) {
            return true;
        }
        // Any part after a dot counts, so "photo.php.jpg" is refused as well
        $parts = explode('.', $name);
        array_shift($parts);
        foreach ($parts as $part) {
            if (in_array(trim($part), self::BLOCKED_EXTENSIONS, true)) {
                return true;
            }
        }
        return false;
    }
}
