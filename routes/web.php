<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard');
    Route::get('/shame', function () { return view('hall-of-shame'); })->name('hall-of-shame');
});

Route::middleware('admin')->group(function () {
    // Routes or controller actions that require administrator privileges
    Route::get('score-registration', [\App\Http\Controllers\ScoreController::class, 'index'])->name('score-registration');
    Route::post('store-score', [\App\Http\Controllers\ScoreController::class, 'store'])->name('score-store');
});

