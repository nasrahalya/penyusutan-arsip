<?php

use App\Http\Controllers\BerkasPenyusutanArsipController;
use App\Http\Controllers\DaftarArsipController;
use App\Http\Controllers\TertibArsipController;
use App\Models\DaftarArsip;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DaftarArsipInaktifController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::resource('tertibArsip', TertibArsipController::class);
Route::resource('daftarArsip', DaftarArsipController::class);
Route::resource('arsipInaktif', DaftarArsipInaktifController::class);
Route::resource('penyusutan', BerkasPenyusutanArsipController::class);

Route::get('penyusutan-kirim/{id}',[BerkasPenyusutanArsipController::class,'kirim'])->name('penyusutan.kirim');
Route::get('login', [AuthController::class, 'index'])-> name('login');
Route::post('post-login', [AuthController::class,'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class,'registration'])->name('register');
Route::post('post-registration',[AuthController::class, 'postRegistration'])-> name('register.post');
Route::get('dashboard', [AuthController::class,'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class,'logout'])->name('logout');


Route::resource('users',UserController::class);
Route::resource('roles',RoleController::class);

// daftar arsip inaktif

Route::get('daftararsipinaktif',[DaftarArsipController::class,'daftararsipinaktif'])->name('daftararsip.inaktif');
