<?php
header('Content-Type: text/plain; charset=utf-8');

$paths = [
    __DIR__,
    __DIR__ . '/pak-embassy',
    __DIR__ . '/pak-embassy/pak-embassy',
];

echo "Checking possible Laravel paths:\n\n";

foreach ($paths as $p) {
    $artisan = $p . '/artisan';
    $envFile = $p . '/.env';

    echo "Path: $p\n";
    echo " - artisan: " . (file_exists($artisan) ? 'YES' : 'NO') . "\n";
    echo " - .env: " . (file_exists($envFile) ? 'YES' : 'NO') . "\n";

    if (file_exists($envFile)) {
        $env = file_get_contents($envFile);

        preg_match_all('/^DB_USERNAME=.*$/m', $env, $u);
        preg_match_all('/^DB_PASSWORD=.*$/m', $env, $pw);
        preg_match_all('/^DB_DATABASE=.*$/m', $env, $db);
        preg_match_all('/^CACHE_STORE=.*$/m', $env, $cs);

        echo " - DB_DATABASE lines: " . implode(' | ', $db[0] ?: ['(none)']) . "\n";
        echo " - DB_USERNAME lines: " . implode(' | ', $u[0] ?: ['(none)']) . "\n";
        echo " - DB_PASSWORD lines: " . implode(' | ', $pw[0] ?: ['(none)']) . "\n";
        echo " - CACHE_STORE lines: " . implode(' | ', $cs[0] ?: ['(none)']) . "\n";
    }

    echo str_repeat('-', 70) . "\n";
}