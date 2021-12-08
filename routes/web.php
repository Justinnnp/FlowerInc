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

Route::get('/stocks/{stock}/flowers', [StockController::class, 'flowers'])
    ->name('stock.flowers')
    ->middleware(['auth:sanctum', 'verified']);

Route::resource('flowers', FlowerController::class)->middleware(['auth:sanctum', 'verified']);
