<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'katalog'])->name('katalog');
Route::get('/promo', [HomeController::class, 'promo'])->name('promo');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('kelompok/{id}', [PetaniController::class, 'kelompok'])->name('petani.kelompok');
Route::resource('petani', PetaniController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
