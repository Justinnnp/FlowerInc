<?php

use App\Http\Controllers\FlowerController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
//    ->middleware(['auth:sanctum', 'verified']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('stocks', StockController::class)->middleware(['auth:sanctum', 'verified']);

//flowers

Route::get('/flowers', [FlowerController::class, 'index'])->name('flowers.index')->middleware(['auth:sanctum', 'verified']);

Route::get('/flowers/{flower}', [FlowerController::class, 'show'])->name('flowers.show')->middleware(['auth:sanctum', 'verified']);


//stocks

Route::get('/stocks/{stock}/flowers/create', [FlowerController::class, 'create'])->name('flowers.create')->middleware(['auth:sanctum', 'verified']);

Route::post('/stocks/{stock}/flowers/store', [FlowerController::class, 'store'])->name('flowers.store')->middleware(['auth:sanctum', 'verified']);

Route::get('/stocks/{stock}/flowers/{flower}/edit', [FlowerController::class, 'edit'])->name('flowers.edit')->middleware(['auth:sanctum', 'verified']);

Route::post('/stocks/{stock}/flowers/{flower}/update', [FlowerController::class, 'update'])->name('flowers.update')->middleware(['auth:sanctum', 'verified']);

Route::delete('/stocks/{stock}/flowers/{flower}/delete', [FlowerController::class, 'destroy'])->name('flowers.destroy')->middleware(['auth:sanctum', 'verified']);

Route::resource('users', UserController::class);

//Route::resource('flowers', FlowerController::class)->middleware(['auth:sanctum', 'verified']);
