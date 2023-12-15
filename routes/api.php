<?php

use App\Http\Controllers\StatusController;
use App\Http\Controllers\TelegramBotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/telegram-bot', TelegramBotController::class);
Route::apiResource('/statuses', StatusController::class);

