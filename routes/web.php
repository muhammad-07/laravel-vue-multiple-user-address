<?php

use App\Models\Book;
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
// Route::get('{any}', function () {
//     return view('layouts.app');
// })->where('any', '.*');

Route::get('/', function () {
    return view('welcome');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/es_index_all', [App\Http\Controllers\BookController::class, 'es_index_all'])->name('es_index_all');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// for manual test
// Route::get('/es_store', [App\Http\Controllers\BookController::class, 'es_store'])->name('es_store');
// Route::get('/es_update', [App\Http\Controllers\BookController::class, 'es_update'])->name('es_update');
