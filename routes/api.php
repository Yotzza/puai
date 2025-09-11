<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RobaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IzvestajController;
use App\Http\Controllers\Api\ZaposleniController;
use App\Http\Controllers\Api\TransakcijaController;
use App\Http\Controllers\Api\RobaTransakcijasController;
use App\Http\Controllers\Api\ZaposleniIzvestajsController;
use App\Http\Controllers\Api\ZaposleniTransakcijasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('robas', RobaController::class);

        // Roba Transakcijas
        Route::get('/robas/{roba}/transakcijas', [
            RobaTransakcijasController::class,
            'index',
        ])->name('robas.transakcijas.index');
        Route::post('/robas/{roba}/transakcijas', [
            RobaTransakcijasController::class,
            'store',
        ])->name('robas.transakcijas.store');

        Route::apiResource('zaposlenis', ZaposleniController::class);

        // Zaposleni Izvestajs
        Route::get('/zaposlenis/{zaposleni}/izvestajs', [
            ZaposleniIzvestajsController::class,
            'index',
        ])->name('zaposlenis.izvestajs.index');
        Route::post('/zaposlenis/{zaposleni}/izvestajs', [
            ZaposleniIzvestajsController::class,
            'store',
        ])->name('zaposlenis.izvestajs.store');

        // Zaposleni Transakcijas
        Route::get('/zaposlenis/{zaposleni}/transakcijas', [
            ZaposleniTransakcijasController::class,
            'index',
        ])->name('zaposlenis.transakcijas.index');
        Route::post('/zaposlenis/{zaposleni}/transakcijas', [
            ZaposleniTransakcijasController::class,
            'store',
        ])->name('zaposlenis.transakcijas.store');

        Route::apiResource('izvestajs', IzvestajController::class);

        Route::apiResource('transakcijas', TransakcijaController::class);
    });
