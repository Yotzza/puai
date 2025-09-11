<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RobaController;
use App\Http\Controllers\IzvestajController;
use App\Http\Controllers\ZaposleniController;
use App\Http\Controllers\TransakcijaController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('robas', RobaController::class);
        Route::resource('zaposlenis', ZaposleniController::class);
        Route::resource('izvestajs', IzvestajController::class);
        Route::resource('transakcijas', TransakcijaController::class);
    });
