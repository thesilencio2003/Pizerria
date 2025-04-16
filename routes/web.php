<?php

 use App\Http\Controllers\ProfileController;
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\ClientsController;
 use App\Http\Controllers\employeesController;
 use App\Http\Controllers\Extra_IngredientsController;
 use App\Http\Controllers\OrderController;
 use App\Http\Controllers\OrderExtraIngredientController;
 use App\Http\Controllers\OrderPizzaController;
 
 use App\Http\Controllers\BranchController;
 use App\Http\Controllers\raw_materialsController;
 use App\Http\Controllers\SupplierController;
 use App\Http\Controllers\PurchaseController;
 use App\Http\Controllers\PizzaRawMaterialController;
 
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

    Route::get('/extra_ingredients', [Extra_IngredientsController::class,'index'])->name('extra_ingredients.index');
    Route::post('/extra_ingredients', [Extra_IngredientsController::class, 'store'])->name('extra_ingredients.store');
    Route::get('/extra_ingredients/create', [Extra_IngredientsController::class,'create'])->name('extra_ingredients.create');
    Route::delete('/extra_ingredients/{id}', [Extra_IngredientsController::class, 'destroy'])->name('extra_ingredients.destroy');
    Route::put('/extra_ingredients/{id}', [Extra_IngredientsController::class, 'update'])->name('extra_ingredients.update');
    Route::get('/extra_ingredients/{id}/edit', [Extra_IngredientsController::class, 'edit'])->name('extra_ingredients.edit');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    Route::get('/order_extra_ingredient', [OrderExtraIngredientController::class, 'index'])->name('order_extra_ingredient.index');
    Route::post('/order_extra_ingredient', [OrderExtraIngredientController::class, 'store'])->name('order_extra_ingredient.store');
    Route::get('/order_extra_ingredient/create', [OrderExtraIngredientController::class, 'create'])->name('order_extra_ingredient.create');
    Route::delete('/order_extra_ingredient{id}', [OrderExtraIngredientController::class, 'destroy'])->name('order_extra_ingredient.destroy');
    Route::put('/order_extra_ingredient{id}', [OrderExtraIngredientController::class, 'update'])->name('order_extra_ingredient.update');
    Route::get('/order_extra_ingredient{id}/edit', [OrderExtraIngredientController::class, 'edit'])->name('order_extra_ingredient.edit');

    Route::get('/order_pizza', [OrderPizzaController::class, 'index'])->name('order_pizza.index');
    Route::post('/order_pizza', [OrderPizzaController::class, 'store'])->name('order_pizza.store');
    Route::get('/order_pizza/create', [OrderPizzaController::class, 'create'])->name('order_pizza.create');
    Route::delete('/order_pizza/{order_pizza}', [OrderPizzaController::class, 'destroy'])->name('order_pizza.destroy');
    Route::put('/order_pizza/{order_pizza}', [OrderPizzaController::class, 'update'])->name('order_pizza.update');
    Route::get('/order_pizza/{order_pizza}/edit', [OrderPizzaController::class, 'edit'])->name('order_pizza.edit');

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
