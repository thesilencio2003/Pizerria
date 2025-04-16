<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\ClientsController;
 use App\Http\Controllers\employeesController;
 use App\Http\Controllers\pizzaController;
 use App\Http\Controllers\PurchaseController;
 use App\Http\Controllers\ingredientsController;
 use App\Http\Controllers\pizza_sizeController;
 use App\Http\Controllers\pizza_ingredientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
    Route::get ('/users/create', [UserController::class,'create'])->name('users.create');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put( '/users/{id}', [UserController::class,'update'])->name('users.update');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/clients', [ClientsController::class,'index'])->name('clients.index');
    Route::post('/clients', [ClientsController::class,'store'])->name('clients.store');
    Route::get('/clients/create', [ClientsController::class,'create'])->name('clients.create');
    Route::delete('/clients/{id}', [ClientsController::class, 'destroy'])->name('clients.destroy');
    Route::put( '/clients/{id}', [ClientsController::class,'update'])->name('clients.update');
    Route::get('/clients/{id}/edit', [ClientsController::class, 'edit'])->name('clients.edit');

    Route::get('/employees', [employeesController::class,'index'])->name('employees.index');
    Route::get('/employees/create', [employeesController::class,'create'])->name('employees.create');
    Route::post('/employees', [employeesController::class,'store'])->name('employees.store');
    Route::put( '/employees/{id}', [employeesController::class,'update'])->name('employees.update');
    Route::get('/employees/{id}/edit', [employeesController::class, 'edit'])->name('employees.edit');
    Route::delete('/employees/{id}', [employeesController::class, 'destroy'])->name('employees.destroy');

    Route::resource('purchases', PurchaseController::class);

    Route::get('/pizza', [pizzaController::class,'index'])->name('pizzas.index');
    Route::get('/pizzas/create', [PizzaController::class, 'create'])->name('pizzas.create');
    Route::post('/pizzas', [PizzaController::class, 'store'])->name('pizzas.store');
    Route::get('/pizzas/{id}/edit', [PizzaController::class, 'edit'])->name('pizzas.edit');
    Route::delete('/pizza/{id}', [PizzaController::class, 'destroy'])->name('pizzas.destroy');
    Route::get('/pizzas/{id}', [PizzaController::class, 'show'])->name('pizzas.show');
    Route::put('/pizzas/{id}', [PizzaController::class, 'update'])->name('pizzas.update');
    
    Route::get('/ingredients', [ingredientsController::class,'index'])->name('ingredents.index');
    Route::get('/ingredients/create', [ingredientsController::class, 'create'])->name('ingredients.create');
    Route::post('/ingredients', [ingredientsController::class, 'store'])->name('ingredients.store');
    Route::put('/ingredients/{ingredient}', [ingredientsController::class, 'update'])->name('ingredients.update');
    Route::get('ingredients/{ingredient}/edit', [ingredientsController::class, 'edit'])->name('ingredients.edit');});
    Route::delete('/ingredients/{id}', [ingredientsController::class, 'destroy'])->name('ingredients.destroy');

    Route::get('/piza_size', [pizza_sizeController::class,'index'])->name('piza_size.index');
    Route::get('/piza_size/create', [pizza_sizeController::class, 'create'])->name('piza_size.create');
    Route::post('/piza_size', [pizza_sizeController::class, 'store'])->name('piza_size.store');
    Route::get('/piza_size/{pizza_size}/edit', [pizza_sizeController::class, 'edit'])->name('piza_size.edit');
    Route::put('/piza_size/{pizza_size}', [pizza_sizeController::class, 'update'])->name('piza_size.update');
    Route::delete('/piza_size/{id}', [pizza_sizeController::class, 'destroy'])->name('piza_size.destroy');

    Route::get('/pizza_ingredient', [pizza_ingredientController::class,'index'])->name('pizza_ingredient.index');
    Route::get('/pizza_ingredient/create', [pizza_ingredientController::class, 'create'])->name('pizza_ingredient.create');
    Route::post('/pizza_ingredient', [pizza_ingredientController::class, 'store'])->name('pizza_ingredient.store');
    Route::get('/pizza_ingredient/{pizzaIngredient}/edit', [pizza_ingredientController::class, 'edit'])->name('pizza_ingredient.edit');
    Route::put('/pizza_ingredient/{pizzaIngredient}', [pizza_ingredientController::class, 'update'])->name('pizza_ingredient.update');
    Route::delete('/pizza_ingredient/{id}', [pizza_ingredientController::class, 'destroy'])->name('pizza_ingredient.destroy');

require __DIR__.'/auth.php';
