<?php
set_time_limit(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=utf-8');

$source = __DIR__ . '/pak-embassy/public';
$target = __DIR__;

if (!is_dir($source)) {
    exit("Source not found: $source\n");
}

function copyRecursive($src, $dst) {
    if (is_dir($src)) {
        if (!is_dir($dst)) {
            mkdir($dst, 0755, true);
        }
        $items = scandir($src);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            copyRecursive($src . '/' . $item, $dst . '/' . $item);
        }
    } else {
        copy($src, $dst);
    }
}

$items = scandir($source);
foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;

    // Keep your custom root runner/debug files if any
    if (in_array($item, ['test-assets.php'])) continue;

    copyRecursive($source . '/' . $item, $target . '/' . $item);
    echo "Copied: $item\n";
}

echo "\nDone. Assets published to public_html.\n";
echo "Now hard refresh browser (Ctrl+F5) and delete test-assets.php\n";