<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\raw_materialsController;

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PizzaRawMaterialController;

/* Web Routes */


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de branches (sucursal)
    Route::resource('branches', BranchController::class);

    // Rutas de suppliers (proveedores)
    Route::resource('suppliers', SupplierController::class);

    // Rutas de raw_materials (Materiales)
    Route::resource('raw_materials', raw_materialsController::class); 

    // Rutas de Purchases 
    Route::resource('purchases', PurchaseController::class);

    // Rutas de pizza_raw_materials 
    Route::resource('pizza_raw_materials', PizzaRawMaterialController::class);
});

require __DIR__.'/auth.php';
