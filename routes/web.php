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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::group(['middleware' => 'auth', 'prefix' => 'sites'], function () {
    Route::get('/{site}', [
        App\Http\Controllers\SitesController::class,
        'show',
    ])->name('sites.show');
    Route::get('', [
        App\Http\Controllers\SitesController::class,
        'create',
    ])->name('sites.create');
    Route::post('/{site}/delete', [
        App\Http\Controllers\SitesController::class,
        'delete',
    ])->name('sites.delete');
    Route::get('/{site}/update', [
        App\Http\Controllers\SitesController::class,
        'update',
    ])->name('sites.update');
    Route::post('', [
        App\Http\Controllers\SitesController::class,
        'store',
    ])->name('sites.store');
});
