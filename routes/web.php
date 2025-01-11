<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukukategoriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('admin', function () {
    return view('dashboard');
})->middleware('admin');

Route::get('petugas', function () {
    return view('dashboard');
})->middleware('petugas');

Route::resource('bukus', BukuController::class);
Route::resource('kategoris', KategoriController::class);
Route::resource('bukukategoris', BukukategoriController::class);
Route::resource('peminjamen', PeminjamanController::class);
Route::resource('koleksis', KoleksiController::class);
Route::resource('ulasans', UlasanController::class); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
