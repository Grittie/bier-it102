<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberListController;

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

Route::get('/guest_dashboard', function () { return view('guest-dashboard'); })->name('guest-dashboard');
Route::get('/guest_leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('guest-leaderboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/todo', function () { return view('to-do'); })->name('to-do');
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard');
    Route::get('/sessions', [\App\Http\Controllers\SessionController::class, 'index'])->name('sessions');
    Route::get('/shame', function () { return view('hall-of-shame'); })->name('hall-of-shame');
});

Route::middleware('admin')->group(function () {
    // Routes or controller actions that require administrator privileges
    Route::get('score-registration', [\App\Http\Controllers\ScoreController::class, 'index'])->name('score-registration');
    Route::get('/memberlist', [\App\Http\Controllers\MemberListController::class, 'index'])->name('memberlist');
    Route::put('/memberlist/{id}', [MemberListController::class, 'update'])->name('memberlist.update');
    Route::delete('/memberlist/{user}', [MemberListController::class, 'destroy'])->name('memberlist.destroy');
    Route::post('store-score', [\App\Http\Controllers\ScoreController::class, 'store'])->name('score-store');
});

