<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DepartmentsController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['verified', 'auth'],
    'as' => 'dashboard.',
    'prefix' => '/dashboard'
], function () {
    // departments route
    Route::get('/department', [DepartmentsController::class, 'index'])->name('departments.index');
    Route::get('/department/add-department', [DepartmentsController::class, 'create'])->name('department.add');
    Route::post('/department/store', [DepartmentsController::class, 'store'])->name('departments.store');
    Route::delete('/department/{department}/delete', [DepartmentsController::class, 'delete'])->name('departments.delete');
    Route::get('/department/trashed', [DepartmentsController::class, 'trash'])->name('departments.trash');
    Route::put('/department/{department}/restore', [DepartmentsController::class, 'restore'])->name('departments.restore');
    Route::delete('/department/{department}/force-delete', [DepartmentsController::class, 'forceDelete'])->name('departments.force-delete');
    Route::get('/department/{department:slug}/edit', [DepartmentsController::class, 'edit'])->name('departments.edit');
    Route::put('/department/{id}/update', [DepartmentsController::class, 'update'])->name('departments.update');
    // Categories route
    Route::resource('/categories', CategoryController::class)->except(['show', 'create', 'edit'])->names('categories');
    Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('/categories/add-category', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
    // products route
    Route::get('/products/add-products', [ProductsController::class, 'create'])->name('product.create');
    // Route::get('/products/{number}', [ProductsController::class, 'getDepartment'])->name('categories.getDepartments');
    Route::get('/products/trashed', [ProductsController::class, 'trash'])->name('products.trash');
    Route::put('/products/{product}/restore', [ProductsController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete', [ProductsController::class, 'forceDelete'])->name('products.force-delete');
    Route::get('/products/{product:slug}/show', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/products/{product:slug}/update-product', [ProductsController::class, 'edit'])->name('products.edit');
    Route::resource('/products', ProductsController::class)->except(['create', 'show', 'edit'])->names('products');

    // orders route
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [OrdersController::class, 'update'])->name('orders.update');
    Route::get('/orders/show/{order}', [OrdersController::class, 'show'])->name('orders.show');
    // user route
    Route::get('/users', [UsersController::class, 'index'])->name('users.view');
});
