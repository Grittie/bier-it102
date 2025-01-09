<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SessionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::get('create-post', 'Api\RegisterController@register');
});

// Temperature routes
Route::post('/temperature', [ApiController::class, 'storeTemperature']);
Route::get('/temperature/latest', [ApiController::class, 'getLatestTemperature']);
Route::get('/temperature/recent', [ApiController::class, 'getRecentTemperatures']);

// Connection routes
Route::post('/connection', [ApiController::class, 'storeConnectionStatus']);
Route::get('/connection', [ApiController::class, 'getConnectionStatus']);

// Heartbeat routes
Route::post('/heartbeat', [ApiController::class, 'storeHeartbeat']);
Route::get('/heartbeat', [ApiController::class, 'getHeartbeatStatus']);

// Device information routes
Route::post('/address', [ApiController::class, 'storeDeviceInformation']);
Route::get('/address', [ApiController::class, 'getLatestDeviceInformation']);

// Reset routes
Route::post('/reset', [ApiController::class, 'resetESP32'])->name('api.reset');

// Card and session routew
Route::post('/card', [SessionController::class, 'handleCard']);
