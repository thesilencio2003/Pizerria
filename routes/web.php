<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\RawMaterialController;


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
    Route::resource('suppliers', SuppliersController::class);

    // Rutas de raw_materials (Materiales)
    Route::resource('raw_materials', RawMaterialController::class); 

    // Rutas de Purchases 
    Route::resource('purchases', PurchaseController::class);
});

require __DIR__.'/auth.php';
