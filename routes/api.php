<?php

use App\Http\Controllers\api\ClientsController;
use App\Http\Controllers\api\EmployeesController;
use App\Http\Controllers\api\PizzaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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