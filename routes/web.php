<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FavouriteController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Dashboard\OrdersController as DashboardOrderController;
use App\Http\Controllers\Front\ColorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DepartmentsController as DashboardDepartmentController;
use App\Http\Controllers\Dashboard\ProductsController as DashboardProductsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Front\PaymentController;

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
// authentication
Route::get('auth/{provider}/redirect', [SocialiteLoginController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteLoginController::class, 'callback'])->name('auth.reidrect.callback');

// Front Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // product
    Route::get('/products/favourite', [FavouriteController::class, 'index'])->name('front.favourite');
    Route::post('/shopping/add-favourite/{product:slug}', [FavouriteController::class, 'store'])->name('add.favourite.product');
    Route::delete('/shopping/remove-favourite/{product:slug}', [FavouriteController::class, 'destroy'])->name('remove.favourite.product');
    Route::post('/shopping/add-review/{product:slug}', CommentController::class)->name('add.review.product');

    // checkout
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    // order
    Route::get('/orders', [OrdersController::class, 'index'])->name('front.order.index');
    Route::get('/orders/show/{order}', [OrdersController::class, 'show'])->name('front.order.show');
    Route::post('/payment/{order}', [PaymentController::class, 'payment'])->name('payment');

    Route::view('payment', 'paypal.index')->name('create.payment');
    Route::get('payment/{order}/pay', [PaymentController::class, 'store'])->name('create.payment');
    Route::get('payment/{order}/cancel', [PaymentController::class, 'cancel'])->name('cancel.payment');
    Route::get('payment/{order}/success', [PaymentController::class, 'success'])->name('success.payment');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
// products
Route::get('/shopping/{department}', [ColorController::class, 'getColorSize'])->name('color.size');
Route::get('/shopping/show-product/{product}/{color}', [ColorController::class, 'getSizeForProduct'])->name('product.size');
Route::get('/shopping/show-product/{product:slug}', [ProductsController::class, 'show'])->name('front.product.show');
Route::get('/shopping/{department:slug}/serching', [ProductsController::class, 'index'])->name('front.product.index');
Route::get('/products/{category}', [ProductsController::class, 'getDepartment'])->name('categories.getDepartments');

// cart
Route::get('/cart/shopping', [CartController::class, 'index'])->name('front.cart.shopping');
Route::delete('/cart/shopping/delete-products/{product:slug}', [CartController::class, 'destroy'])->name('front.cart.delete-product');
Route::post('/cart/shopping/{product}', [CartController::class, 'store'])->name('front.cart.add');



// Dashboard Routes


Route::middleware(['verified', 'auth', 'can:is_admin'])->prefix('/dashboard')->as('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // departments route
    Route::get('/department/trashed', [DashboardDepartmentController::class, 'trash'])->name('departments.trash');
    Route::put('/department/{department}/restore', [DashboardDepartmentController::class, 'restore'])->name('departments.restore');
    Route::delete('/department/{department}/force-delete', [DashboardDepartmentController::class, 'forceDelete'])->name('departments.force-delete');
    Route::get('/department/{department:slug}/edit', [DashboardDepartmentController::class, 'edit'])->name('departments.edit');
    Route::resource('departments', DashboardDepartmentController::class)->names([
        'create' => 'department.add'
    ])->except('edit');
    Route::get('/get-categories/{department}', [DashboardDepartmentController::class, 'getCategories']);

    // Categories route
    Route::resource('/categories', CategoryController::class)->except(['show', 'create', 'edit'])->names('categories');
    Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('/categories/add-category', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    // products route
    Route::get('/products/add-products', [DashboardProductsController::class, 'create'])->name('product.create');
    Route::get('/products/trashed', [DashboardProductsController::class, 'trash'])->name('products.trash');
    Route::put('/products/{product}/restore', [DashboardProductsController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete', [DashboardProductsController::class, 'forceDelete'])->name('products.force-delete');
    Route::get('/products/{product:slug}/show', [DashboardProductsController::class, 'show'])->name('products.show');
    Route::get('/products/{product:slug}/update-product', [DashboardProductsController::class, 'edit'])->name('products.edit');
    Route::resource('/products', DashboardProductsController::class)->except(['create', 'show', 'edit'])->names('products');

    // orders route
    Route::get('/orders', [DashboardOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [DashboardOrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/show/{order}', [DashboardOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}', [DashboardOrderController::class, 'update'])->name('orders.update');

    // user route
    Route::get('/users', UsersController::class)->name('users.view');
});


require __DIR__ . '/auth.php';
