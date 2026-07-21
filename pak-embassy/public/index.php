<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/pak-embassy/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/pak-embassy/vendor/autoload.php';

(require_once __DIR__.'/pak-embassy/bootstrap/app.php')
    ->handleRequest(Request::capture());