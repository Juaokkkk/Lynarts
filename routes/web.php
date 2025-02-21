<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClothesController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StyleController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('suporte', function (){
    return view('pages.suport');
})->name('suporte');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
    
Route::resource('clothes', ClothesController::class);
Route::resource('size', SizeController::class);
Route::resource('style', StyleController::class);