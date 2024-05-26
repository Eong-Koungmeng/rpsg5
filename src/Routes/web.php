<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/game/play', [GameController::class, 'index'])->name('homegame');
Route::post('/game/save', [GameController::class, 'play'])->name('play');
Route::post('/reset', [GameController::class, 'reset'])->name('reset');
Route::post('/save-score', [GameController::class, 'saveScore'])->name('save-score');
Route::get('/game/leaderboard', [DashboardController::class, 'index'])->name('leaderboard');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect(route('leaderboard'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
