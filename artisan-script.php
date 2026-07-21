<?php
/**
 * One-time Laravel deploy runner — NO AUTH (delete immediately after use).
 */

set_time_limit(0);
ini_set('display_errors', '1');
error_reporting(E_ALL);

$projectPath = __DIR__ . '/pak-embassy';
$artisanPath = $projectPath . '/artisan';

if (!is_dir($projectPath) || !file_exists($artisanPath)) {
    http_response_code(500);
    exit('Project/artisan not found at: ' . htmlspecialchars($projectPath));
}

chdir($projectPath);

header('Content-Type: text/plain; charset=utf-8');
echo "Working dir: " . getcwd() . "\n\n";

$commands = [
    'php artisan down || true',
    'php artisan config:clear',
    'php artisan cache:clear',
    'php artisan route:clear',
    'php artisan view:clear',
    'php artisan migrate --force',
    'php artisan db:seed --force',
    'php artisan storage:link',
    'php artisan config:cache',
    'php artisan route:cache',
    'php artisan view:cache',
    'php artisan up',
];

foreach ($commands as $cmd) {
    echo ">>> $cmd\n";
    $output = [];
    $exitCode = 0;
    exec($cmd . ' 2>&1', $output, $exitCode);
    echo implode("\n", $output) . "\n";
    echo "[exit code: $exitCode]\n" . str_repeat('-', 60) . "\n";
}

echo "\nDone. DELETE deploy-runner.php from public_html NOW.\n";