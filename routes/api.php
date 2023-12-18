<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SourceTypeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TelegramBotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/telegrams', TelegramBotController::class);
Route::apiResource('/statuses', StatusController::class);
Route::apiResource('/courses', CourseController::class);
Route::apiResource('/source-types', SourceTypeController::class);
Route::apiResource('/sources', SourceController::class);

