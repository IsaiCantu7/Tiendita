<?php
// Importamos los controladores que vamos a utilizar
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\InventoriesController;
use Illuminate\Support\Facades\Route;

// Esta ruta es para la página de inicio de la aplicación
Route::get('/', function () {
    return view('welcome');
});

// Esta ruta es para el dashboard de la aplicación
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Esta ruta es para la autenticación de los usuarios
Route::middleware('auth')->group(function () {
    // Rutas para el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recursos para los productos, categorías, clientes, ventas e inventarios, los recursos son las rutas que sirven para realizar operaciones CRUD
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('inventories', InventoriesController::class);
});

require __DIR__.'/auth.php';
