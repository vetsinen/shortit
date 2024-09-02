<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

// Define API Routes
Route::post('/shorten', [UrlController::class, 'shorten']);