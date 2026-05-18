<?php

use App\Http\Controllers\Api\ReadingApiController;
use App\Http\Controllers\Api\GenreApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('readings', ReadingApiController::class)
    ->names('api.readings');

Route::apiResource('genres', GenreApiController::class)
    ->names('api.genres');