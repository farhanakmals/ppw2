<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Buku
Route::get('/', [BukuController::class, 'index']);
Route::get('/create',  [BukuController::class, 'create'])->name('buku.create');
Route::post('/', [BukuController::class, 'store'])->name('buku.store');

Route::get('/update/{id}',  [BukuController::class, 'edit'])->name('buku.edit');
Route::post('/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
Route::post('/update/{id}',  [BukuController::class, 'update'])->name('buku.update');

Route::post('/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/search', [BukuController::class, 'search'])->name('buku.search');

Route::get('/detail-buku/{bukuSeo}', [BukuController::class, 'galeriBuku'])->name('buku.detail');

Route::get('/like/{id}', [BukuController::class, 'likeFoto'])->name('buku.like');

// User
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');;
Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
Route::get('/galeri/update/{id}', [GaleriController::class, 'edit'])->name('galeri.edit');
Route::post('/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::post('/galeri/delete/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

// Komentar
Route::post('/komentar/{bukuId}', [KomentarController::class, 'store'])->name('komentar.store');