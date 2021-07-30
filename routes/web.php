<?php

use App\Http\Controllers\CategoryController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'AuthController@index')->name('login');
Route::get('login', 'AuthController@index')->name('login');
Route::post('login', 'AuthController@login');

Route::get('/ganti_password/{id}', 'AuthController@ganti_password')->name('ganti_password');
Route::post('/ganti_password/{id}', 'AuthController@konfir_ganti_password')->name('ganti_password.konfir');

Route::get('lupa_password', 'AuthController@lupa_password')->name('lupa_password');
Route::post('lupa_password', 'AuthController@konfir_lupa_password');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::get('/order/pdf/{invoice}', 'OrderController@invoicePdf')->name('order.pdf');
    Route::get('/order/excel/{invoice}', 'OrderController@invoiceExcel')->name('order.excel');

    Route::middleware(['checkRole:kasir'])->group(function () {
        Route::get('/transaksi', 'OrderController@addOrder')->name('order.transaksi');
        Route::get('/checkout', 'OrderController@checkout')->name('order.checkout');
        Route::post('/checkout', 'OrderController@storeOrder')->name('order.storeOrder');
    });

    Route::middleware(['checkRole:admin,barista,dapur'])->group(function () {
        Route::middleware(['checkRole:admin'])->group(function () {
            Route::resource('/kategori', 'CategoryController')->except(['create', 'show']);
            Route::resource('/user', 'UserController');
            Route::resource('/report', 'ReportController')->except(['create', 'show']);
            Route::get('/report/pdf/{invoice}', 'ReportController@invoicePdf')->name('report.pdf');
        });

        Route::resource('/produk', 'ProductController');
        Route::resource('/bahan', 'BahanController')->except(['create', 'show']);
    });
});