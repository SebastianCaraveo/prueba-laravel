<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'welcome'])->name('welcome');

Route::middleware(['auth', 'is_admin'])->prefix('dashboard')->group( function (){
    Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::prefix('categories')->group( function (){
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('insert/categories', [CategoryController::class, 'store'])->name('store_category');
        Route::put('update/categories/{id}', [CategoryController::class, 'update'])->name('update_category');
        Route::delete('delete/categories/{id}', [CategoryController::class, 'destroy'])->name('delete_category');
    }); //Grupo de rutas para las categorias
    Route::resource('products', ProductController::class);// <- Hace todas las solicitudes http y lo del controlador (index, create, store, show, edit, update, destroy)
    Route::delete('/products/{product}/images/{image}', [ProductController::class, 'deleteImage'])->name('products.images.delete');//Ruta para eliminar una de las imagenes del producto
    //Grupo de rutas para los productos
});





Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
