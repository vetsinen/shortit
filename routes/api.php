<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define API Routes

// Get all items
Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Data retrieved successfully!',
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2',
        ],
    ]);
});