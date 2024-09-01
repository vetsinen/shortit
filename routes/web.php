<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', function () {
    return response()->file(public_path('index.html'));
    //return view('welcome');
});
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Data retrieved successfully!',
        'data' => [
            'key1' => '42',
        ],
    ]);
});
Route::get('/{hash}', [UrlController::class, 'redirect']);
