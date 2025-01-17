<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('chirps', ChirpController::class)
->only(['index', 'store', 'edit', 'update', 'destroy','create'])
->middleware(['auth','verified']);

Route::get('chirps/{chirp}/reply', [ReplyController::class, 'reply'])
    ->name('chirps.reply')
    ->middleware(['auth','verified']);

    Route::post('chirps/{chirp}/storereply', [ReplyController::class, 'storereply'])
    ->name('chirps.storereply')
    ->middleware(['auth','verified']);

    Route::get('chirps/{reply}/destroyreply', [ReplyController::class, 'destroyreply'])
    ->name('chirps.destroyreply')
    ->middleware(['auth','verified']);

require __DIR__.'/auth.php';
