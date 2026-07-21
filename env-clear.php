<?php
set_time_limit(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

/**
 * REPLACE THESE 3 VALUES FIRST
 */
$dbName = 'dbwjppgeeqjhiu';
$dbUser = 'uop6h9tlalife';
$dbPass = '11%G]3)$1$f7';

$possiblePaths = [
    __DIR__ . '/pak-embassy',
    __DIR__ . '/pak-embassy/pak-embassy',
    __DIR__,
];

$projectPath = null;
foreach ($possiblePaths as $p) {
    if (file_exists($p . '/artisan')) {
        $projectPath = $p;
        break;
    }
}

if (!$projectPath) {
    exit("artisan not found\n");
}

echo "Project path: $projectPath\n";

$envPath = $projectPath . '/.env';
if (!file_exists($envPath)) {
    exit(".env not found at: $envPath\n");
}

$env = file_get_contents($envPath);

function setEnvValue($env, $key, $value) {
    $pattern = "/^{$key}=.*$/m";
    $line = $key . '=' . $value;
    if (preg_match($pattern, $env)) {
        return preg_replace($pattern, $line, $env);
    }
    return rtrim($env) . "\n" . $line . "\n";
}

$env = setEnvValue($env, 'APP_ENV', 'production');
$env = setEnvValue($env, 'APP_DEBUG', 'false');
$env = setEnvValue($env, 'APP_URL', 'https://connect.pakistaninksa.com');

$env = setEnvValue($env, 'DB_CONNECTION', 'mysql');
$env = setEnvValue($env, 'DB_HOST', 'localhost');
$env = setEnvValue($env, 'DB_PORT', '3306');
$env = setEnvValue($env, 'DB_DATABASE', $dbName);
$env = setEnvValue($env, 'DB_USERNAME', $dbUser);
$env = setEnvValue($env, 'DB_PASSWORD', $dbPass);

$env = setEnvValue($env, 'CACHE_STORE', 'file');
$env = setEnvValue($env, 'SESSION_DRIVER', 'file');
$env = setEnvValue($env, 'QUEUE_CONNECTION', 'sync');

file_put_contents($envPath, $env);
echo ".env updated\n";

// remove cached bootstrap config files
$cacheFiles = [
    $projectPath . '/bootstrap/cache/config.php',
    $projectPath . '/bootstrap/cache/packages.php',
    $projectPath . '/bootstrap/cache/services.php',
];
foreach ($cacheFiles as $f) {
    if (file_exists($f)) {
        unlink($f);
        echo "Deleted: $f\n";
    }
}

chdir($projectPath);

$commands = [
    'php artisan config:clear',
    'php artisan cache:clear',
    'php artisan migrate --force',
    'php artisan db:seed --force',
    'php artisan optimize:clear',
];

foreach ($commands as $cmd) {
    echo "\n>>> $cmd\n";
    $out = [];
    $code = 0;
    exec($cmd . ' 2>&1', $out, $code);
    echo implode("\n", $out) . "\n";
    echo "[exit code: $code]\n";
    if ($code !== 0) {
        echo "Stopped due to error.\n";
        break;
    }
}

echo "\nDone. DELETE fix-db-now.php after this.\n";