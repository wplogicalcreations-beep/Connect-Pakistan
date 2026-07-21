<?php
set_time_limit(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

$projectPath = __DIR__ . '/pak-embassy';

$db = [
    'APP_ENV'          => 'production',
    'APP_DEBUG'        => 'false',

    'DB_CONNECTION'    => 'mysql',
    'DB_HOST'          => '127.0.0.1', // match your .env
    'DB_PORT'          => '3306',
    'DB_DATABASE'      => 'dbwjppgeeqjhiu',
    'DB_USERNAME'      => 'uop6h9tlalife',
    'DB_PASSWORD'      => '@16EL1*~2pk1', // no extra quotes in PHP value

    'CACHE_STORE'      => 'file',
    'SESSION_DRIVER'   => 'file',
    'QUEUE_CONNECTION' => 'sync',
];

if (!file_exists($projectPath . '/artisan')) {
    exit("artisan not found at: {$projectPath}\n");
}

echo "Project: {$projectPath}\n";

// Clear cached config files
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

// Force env vars for this process
foreach ($db as $k => $v) {
    putenv($k . '=' . $v);
    $_ENV[$k] = $v;
    $_SERVER[$k] = $v;
}

chdir($projectPath);

// Run only the seeder you need
$commands = [
    'php artisan db:seed --class=TemplatePageSettingSeeder --force',
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

echo "\nSUCCESS. Now delete this file immediately.\n";