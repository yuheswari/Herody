<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    try {
        DB::connection()->getPdo();
        $database_status = 'connected';
        $health = 'ok';
    } catch (\Exception $e) {
        $database_status = 'error';
        $health = 'degraded';
    }

    return response()->json([
        'status' => 'success',
        'health' => $health,
        'message' => 'Book & Author Management System API',
        'version' => '1.0.0',
        'app_url' => url('/'),
        'api_base_url' => url('/api'),
        'endpoints' => [
            'authors' => url('/api/authors'),
            'books' => url('/api/books'),
        ],
        'documentation' => 'See README.md for full API documentation',
        'database' => $database_status,
        'timestamp' => now()->toIso8601String(),
    ], 200);
});
