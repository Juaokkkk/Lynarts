<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Products\ClothesController;
use App\Http\Controllers\Products\SizeController;
use App\Http\Controllers\Products\StyleController;
use App\Http\Controllers\Sales\SaleController;
use App\Http\Controllers\Sales\MethodController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('suporte', function (){
    return view('pages.suport');
})->name('suporte');

Route::get('catalogo', [ClothesController::class, 'index'])->name('catalogo');

Route::get('deletar', [ClothesController::class, 'delete'])->name('deletar');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
    
    Route::prefix('products')->group(function () {
        Route::resource('clothes', ClothesController::class);
        Route::resource('sizes', SizeController::class);
        Route::resource('styles', StyleController::class);
    });

    Route::prefix('sales')->group(function (){
        Route::resource('sales', SaleController::class);
        Route::resource('methods', SaleController::class);
    });


    Route::delete('/clothes/{id}', [ClothesController::class, 'destroy'])->name('clothes.destroy');

    Route::get('/sale/search', [SaleController::class, 'search'])->name('sale.search');

