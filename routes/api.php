<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;


// Define API Routes

Route::post('/shorten', [UrlController::class, 'shorten']);

//Route::post('/shorten', function () {
//    return response()->json([
//        'status' => 'success',
//        'message' => 'Data retrieved successfully!',
//        'data' => [
//            'original' => 'https://docs.google.com/document/d/1WK39COq51bAAG-ZqPhLUbeEALV0CfBnsxz57y3G-V3M/edit',
//            'short_url' => 'https://ur0.jp/uTueW',
//        ],
//    ]);
//});