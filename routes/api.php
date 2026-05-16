<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSubscriptionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/webhook', [TelegramController::class, 'webhook']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/subscription', [AdminSubscriptionController::class, 'index']);
   Route::post('/subscription/approve/{subscriptionId}', [AdminSubscriptionController::class, 'approvedSubscription']);
   Route::post('/subscription/reject/{subscriptionId}', [AdminSubscriptionController::class, 'rejectedSubscription']);
   Route::post('/subscription/statistic', [AdminSubscriptionController::class, 'statistics']);
   Route::post('/subscription/search', [AdminSubscriptionController::class, 'searchByPhone']);
});
