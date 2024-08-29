<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Data retrieved successfully!',
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2',
        ],
    ]);
    //return view('welcome');
});
