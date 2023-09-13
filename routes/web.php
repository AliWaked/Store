<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\FavouriteController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\DepartmentsController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Dashboard\OrdersController as DashboardOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteLoginController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('front.home');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shopping/{department}', [DepartmentsController::class, 'getColorSize'])->name('color.size');
Route::get('/shopping/show-product/{product:slug}', [ProductsController::class, 'show'])->name('front.product.show');
Route::get('/products/favourite', [FavouriteController::class, 'index'])->name('front.favourite')->middleware('auth');
Route::get('/shopping/{department:slug}/serching', [DepartmentsController::class, 'index'])->name('front.department.index');
Route::get('/shopping/{department:slug}/{product:slug}/searhing', [DepartmentsController::class, 'show'])->name('front.department.product.show');
Route::get('/cart/shopping', [CartController::class, 'index'])->name('front.cart.shopping');
Route::delete('/cart/shopping/delete-products/{product:slug}', [CartController::class, 'destroy'])->name('front.cart.delete-product');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::post('/cart/shopping/{product}', [CartController::class, 'store'])->name('front.cart.add');
Route::post('/shopping/add-favourite/{product:slug}', [ProductsController::class, 'addToFavourite'])->name('add.favourite.product')->middleware('auth');
Route::post('/shopping/remove-favourite/{product:slug}', [ProductsController::class, 'removeToFavourite'])->name('remove.favourite.product')->middleware('auth');
Route::post('/shopping/add-review/{product:slug}', [ProductsController::class, 'addReview'])->name('add.review.product')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/orders', [OrdersController::class, 'index'])->name('front.order.index')->middleware('auth');
Route::get('/orders/show/{order}', [OrdersController::class, 'show'])->name('front.order.show')->middleware('auth');
Route::get('auth/{provider}/redirect', [SocialiteLoginController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteLoginController::class, 'callback'])->name('auth.reidrect.callback');
Route::get('/products/{category}', [ProductsController::class, 'getDepartment'])->name('categories.getDepartments');
Route::put('/orders/{order}', [DashboardOrderController::class, 'update'])->name('orders.update');

// Route::get('/shopping/{department:slug}/serching')

require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
