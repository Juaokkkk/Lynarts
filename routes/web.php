<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Products\ClothesController;
use App\Http\Controllers\Products\SizeController;
use App\Http\Controllers\Products\StyleController;
use App\Http\Controllers\Sales\SaleController;
use App\Http\Controllers\Sales\MethodController;

/*
|--------------------------------------------------------------------------
| PÁGINAS PRINCIPAIS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('suporte', function (){
    return view('pages.suport');
})->name('suporte');

Route::get('catalogo', [ClothesController::class, 'index'])->name('catalogo');

Route::get('deletar', [ClothesController::class, 'delete'])->name('deletar');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PRODUCTS
|--------------------------------------------------------------------------
*/

Route::prefix('products')->group(function () {
    Route::resource('clothes', ClothesController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('styles', StyleController::class);
});

/*
|--------------------------------------------------------------------------
| SALES
|--------------------------------------------------------------------------
*/

Route::prefix('sales')->group(function () {

    // 🔥 ROTAS ESPECÍFICAS (Devem vir antes do Resource para não dar conflito de ID)
    
    // Rota para confirmar o pagamento via AJAX
    Route::post('sales/confirm-payment/{id}', [SaleController::class, 'confirmPayment'])
        ->name('sales.confirmPayment');

    // Rota para exibir a página do PIX
    Route::get('sales/{sale}/pix', [SaleController::class, 'pix'])
        ->name('sales.sales.pix');


    // CRUD de vendas (Deixado por último no grupo para evitar conflitos)
    Route::resource('sales', SaleController::class);

    // CRUD de métodos
    Route::resource('methods', MethodController::class);
});

/*
|--------------------------------------------------------------------------
| OUTRAS ROTAS
|--------------------------------------------------------------------------
*/

// Buscar produto na venda (Autocomplete)
Route::get('/sale/search', [SaleController::class, 'search'])
    ->name('sale.search');

// Deletar roupa
Route::delete('/clothes/{id}', [ClothesController::class, 'destroy'])
    ->name('clothes.destroy');