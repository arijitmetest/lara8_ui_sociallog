<?php

use Illuminate\Support\Facades\Route;


// i have added these
use App\Http\Controllers\GoogleController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// i have added these
Route::get('auth/google',[GoogleController::class,'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback',[GoogleController::class,'hendelGoogleCallback'])->name('auth.google.callback');

