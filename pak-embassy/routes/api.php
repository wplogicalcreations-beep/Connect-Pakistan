<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

// When access token expires sending back this response to user
Route::get('unauthenticated-response', function () {
    return response()->json([
        'success' => false,
        'message' => 'Unauthenticated attempt',
        'data' => null,
        'errors' => [],
        'current_timestamp' => date("Y-m-d H:i:s"),
    ], Response::HTTP_UNAUTHORIZED);
})->name('unauthenticated.response');