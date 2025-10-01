<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mahasiswacontroller;
use App\Http\Controllers\keluargacontroller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [mahasiswaController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
Route::resource('mahasiswanama', mahasiswacontroller::class);
Route::resource('namakeluarga', keluargacontroller::class);


});

require __DIR__.'/auth.php';
