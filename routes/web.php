<?php

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

Route::get('/', [App\Http\Controllers\LoginController::class, 'index']);
Route::post('/ceklogin', [App\Http\Controllers\LoginController::class, 'ceklogin']);
Route::get('/logout', [App\Http\Controllers\logoutController::class, 'logout']);

Route::get('/dash', [App\Http\Controllers\dashboardController::class, 'dash']);

Route::get('/profile', [App\Http\Controllers\userController::class, 'profile']);

Route::get('/mailin', [App\Http\Controllers\mailController::class, 'mailin']);
Route::get('/mailout', [App\Http\Controllers\mailController::class, 'mailout']);

Route::get('/review', [App\Http\Controllers\mailController::class, 'review']);
Route::get('/accept', [App\Http\Controllers\mailController::class, 'accept']);
Route::post('/decline', [App\Http\Controllers\mailController::class, 'decline']);

Route::get('/create', [App\Http\Controllers\mailController::class, 'create']);
Route::post('/insert', [App\Http\Controllers\mailController::class, 'insertmail']);