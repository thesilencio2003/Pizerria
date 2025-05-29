<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BranchApiController;
use App\Http\Controllers\api\PizzaApiRawMaterial;
use App\Http\Controllers\api\ClientsController;
use App\Http\Controllers\api\EmployeesController;
use App\Http\Controllers\api\ExtraIngredientController;
use App\Http\Controllers\api\IngredientController;
use App\Http\Controllers\api\PizzaController;
use App\Http\Controllers\api\PizzaIngredientController;
use App\Http\Controllers\api\UserController;


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
//Route::post('/pizza-raw-materials', [PizzaApiRawMaterial::class, 'store']);
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::post('/clients', [ClientsController::class, 'store'])->name('clients.store');
Route::get('/clients', [ClientsController::class, 'index'])->name('clients');
Route::get('/clients/{client}', [ClientsController::class, 'show'])->name('clients.show');
Route::put('/clients/{client}', [ClientsController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientsController::class, 'destroy'])->name('clients.destroy');

Route::post('/employees', [EmployeesController::class, 'store'])->name('employees.store');
Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
Route::get('/employees/{employee}', [EmployeesController::class, 'show'])->name('employees.show');
Route::put('/employees/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');

Route::post('/pizzas', [PizzaController::class, 'store'])->name('pizzas.store');
Route::get('/pizzas', [PizzaController::class, 'index'])->name('pizzas');
Route::get('/pizzas/{pizza}', [PizzaController::class, 'show'])->name('pizzas.show');
Route::put('/pizzas/{pizza}', [PizzaController::class, 'update'])->name('pizzas.update');
Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');

Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients');
Route::get('/ingredients/{ingredient}', [IngredientController::class, 'show'])->name('ingredients.show');
Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');

Route::post('/pizza-ingredients', [PizzaIngredientController::class, 'store'])->name('pizza_ingredients.store');
Route::get('/pizza-ingredients', [PizzaIngredientController::class, 'index'])->name('pizza_ingredients');
Route::get('/pizza-ingredients/{id}', [PizzaIngredientController::class, 'show'])->name('pizza_ingredients.show');
Route::put('/pizza-ingredients/{id}', [PizzaIngredientController::class, 'update'])->name('pizza_ingredients.update');
Route::delete('/pizza-ingredients/{id}', [PizzaIngredientController::class, 'destroy'])->name('pizza_ingredients.destroy');

Route::post('/extra-ingredients', [ExtraIngredientController::class, 'store'])->name('extra_ingredients.store');
Route::get('/extra-ingredients', [ExtraIngredientController::class, 'index'])->name('extra_ingredients');
Route::get('/extra-ingredients/{id}', [ExtraIngredientController::class, 'show'])->name('extra_ingredients.show');
Route::put('/extra-ingredients/{id}', [ExtraIngredientController::class, 'update'])->name('extra_ingredients.update');
Route::delete('/extra-ingredients/{id}', [ExtraIngredientController::class, 'destroy'])->name('extra_ingredients.destroy');
