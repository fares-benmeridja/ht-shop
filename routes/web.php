<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clearlog', function (){
   return 'truncate -s 0 storage/logs/laravel.log';
});

Route::get('/', App\Http\Controllers\MainController::class)->name('main');

Route::get('/contact-us', [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('/contact-us', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/dairas/{id}', [\App\Http\Controllers\DairaController::class, 'getJson'])->name("dairas.show");
Route::get('/communes/{id}', [\App\Http\Controllers\CommuneController::class, 'getJson'])->name("communes.show");
Auth::routes(['reset' => false]);

Route::get('/all-categories', [App\Http\Controllers\ProductController::class, 'all'])->name('products.all');
Route::get('/category/{category}', [App\Http\Controllers\ProductController::class, 'category'])->name('products.category');
Route::get('/category/{slug}/product/{product}', [App\Http\Controllers\ProductController::class, 'shop'])->name('products.shop');

Route::middleware('auth')->group(function(){

    Route::get('/thankyou/{order}', \App\Http\Controllers\ThanksController::class)->name('thankyou');
    Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/invoice/{order}', [\App\Http\Controllers\InvoiceController::class, 'download'])->name('invoice.download');
    // Cart Routes
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->middleware('cart-empty')->name('cart.index');
    Route::delete('/cart/{rowId}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/{product}', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{rowId}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

    Route::get('/profil', [\App\Http\Controllers\ProfilController::class, 'profil'])->name('profil');
    Route::put('/profil/{user}', [\App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password/{user}', [\App\Http\Controllers\ProfilController::class, 'updatePass'])->name('profil.updatePass');
});

Route::middleware(['auth', 'admin'])->group(function (){
    Route::resource('/contacts', \App\Http\Controllers\ContactController::class)->only(['index', 'show','destroy']);
    Route::resource('/admins', \App\Http\Controllers\AdminManagerController::class);
    Route::get('/dashboard', \App\Http\Controllers\DashController::class)->name('dashboard');
    Route::put('/products/online/{product}', [\App\Http\Controllers\ProductController::class, 'online'])->name('products.online');
    Route::resource('/products', \App\Http\Controllers\ProductController::class);
    Route::resource('/orders', \App\Http\Controllers\OrderController::class)->only(['index', 'show', 'destroy']);
});
