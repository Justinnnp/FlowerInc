<?php

use App\Http\Controllers\FlowerController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('stocks', StockController::class)->middleware(['auth:sanctum', 'verified']);

Route::group(['prefix' => 'stocks/{stock}', 'middleware' => ['auth:sanctum', 'verified']], function() {
    Route::resource('flowers', FlowerController::class);
});
