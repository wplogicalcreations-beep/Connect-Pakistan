<?php
set_time_limit(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

$projectPath = __DIR__ . '/pak-embassy';

// Use your actual DB values here
$db = [
    'DB_CONNECTION' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_DATABASE' => 'dbwjppgeeqjhiu',
    'DB_USERNAME' => 'uop6h9tlalife',
    'DB_PASSWORD' => '@16EL1*~2pk1',
    'CACHE_STORE' => 'file',
    'SESSION_DRIVER' => 'file',
    'QUEUE_CONNECTION' => 'sync',
];

if (!file_exists($projectPath . '/artisan')) {
    exit("artisan not found at: {$projectPath}\n");
}

echo "Project: {$projectPath}\n";

// 1) Delete cached config files
$cacheFiles = [
    $projectPath . '/bootstrap/cache/config.php',
    $projectPath . '/bootstrap/cache/packages.php',
    $projectPath . '/bootstrap/cache/services.php',
];

foreach ($cacheFiles as $f) {
    if (file_exists($f)) {
        unlink($f);
        echo "Deleted cache file: {$f}\n";
    }
}

// 2) Force env vars in this process
foreach ($db as $k => $v) {
    putenv($k . '=' . $v);
    $_ENV[$k] = $v;
    $_SERVER[$k] = $v;
}

chdir($projectPath);

// 3) Run artisan commands
$commands = [
    'php artisan migrate --force',
    'php artisan db:seed --force',
];

foreach ($commands as $cmd) {
    echo "\n>>> {$cmd}\n";
    $out = [];
    $code = 0;
    exec($cmd . ' 2>&1', $out, $code);
    echo implode("\n", $out) . "\n";
    echo "[exit code: {$code}]\n";
    if ($code !== 0) {
        echo "Stopped due to failure.\n";
        exit;
    }
}

echo "\nSUCCESS. Now delete force-migrate.php immediately.\n";