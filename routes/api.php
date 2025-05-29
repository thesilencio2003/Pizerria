<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BranchApiController;
use App\Http\Controllers\Api\PizzaApiRawMaterial;
use App\Http\Controllers\Api\PurchasesApiController;
use App\Http\Controllers\Api\RawApiController;
use App\Http\Controllers\Api\SuppliersApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Branches Routes
Route::apiResource('branches', BranchApiController::class);

// PizzaRawMaterial Routes
Route::get('/pizza-raw-materials', [PizzaApiRawMaterial::class, 'index']);

// Purchases Routes
Route::apiResource('purchases', PurchasesApiController::class);

// Suppliers Routes
Route::apiResource('suppliers', SuppliersApiController::class, );

// Raw-materials Routes
Route::get('/raw-materials', [RawApiController::class, 'index']);
Route::get('/raw-materials/{id}', [RawApiController::class, 'show']);
Route::post('/raw-materials', [RawApiController::class, 'store']);
Route::put('/raw-materials/{id}', [RawApiController::class, 'update']);
Route::delete('/raw-materials/{id}', [RawApiController::class, 'destroy']);
