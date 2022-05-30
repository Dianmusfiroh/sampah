<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Report;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\StatistikController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// get index
Route::get('/template', [TemplateController::class, 'index']);
Route::get('/template', [TemplateController::class, 'detail']);
Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/beranda', [HomeController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/order', [OrderController::class, 'index']);
Route::get('/seller', [SellerController::class, 'index']);
Route::resource('akun', AkunController::class);
Route::resource('report', Report::class);
Route::resource('statistik', StatistikController::class);
Route::get('statistikMember', [StatistikController::class,'statistikMember'])->name('statistikMember');
Route::get('updateStatus',[AkunController::class,'updateStatus'])->name('updateStatus');
Route::get('userAktif',[AkunController::class,'userAktif'])->name('userAktif');
Route::get('produkTerbaik',[Report::class,'topProduk'])->name('topProduk');

Route::post('/login', [LoginController::class, 'log']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/cetakUserAktif', [Report::class, 'cetakAktif_pdf'])->name('cetakAktif');
Route::get('/cetakUserTidakAktif', [Report::class, 'cetakTidakAktif_pdf'])->name('cetakNonAktif');


