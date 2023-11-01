<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Models\Category;
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

//  Halaman home
Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => 'home',
    ]);
});

// Halaman about
Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Bayu",
        "email" => "bayuharimurti2@gmail.com",
        "active" => 'about',
        "image" => "kaltara.png",
    ]);
});

// Halaman seluruh kategory
Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Product Categoies',
        "active" => 'categories',
        'categories' => Category::all(),
    ]);
});

// AUTHENTICATION
// Halaman Login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
// Login
Route::post('/login', [AuthController::class, 'login']);
// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// REGISTRATION
// Halaman Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Registrasi User
Route::post('/register', [RegisterController::class, 'store']);

// PROFILE MANAGEMENT
// Profile User
Route::put('/profile/image/{user:username}', [ProfileController::class, 'updateImage'])->middleware('auth');
// Profile User
Route::resource('/profile', ProfileController::class)->scoped(['user' => 'username'])->middleware('auth');

// PRODUCT MANAGEMENT
// checkSlug
Route::get('/admin/product/checkSlug', [AdminProductController::class, 'checkSlug'])->middleware('auth');
// Admin Controller
Route::resource('/admin/product', AdminProductController::class)->scoped(['product' => 'slug'])->middleware('auth');

// PRODUCT VIEW
// Haaman semua produk
Route::get('/products', [ProductController::class, 'index']);
// Halaman detail produk
Route::get('products/{product:slug}', [ProductController::class, 'show']);

// TRANSACTION MANAGEMENT
// Halaman pembelian
Route::get('/purchase/product/{product:slug}', [ProductController::class, 'purchase'])->middleware('auth');
// Halaman Daftar pembelian buyer
Route::get('/purchase/offers', [TransactionController::class, 'buyerOffers'])->middleware('auth');
// Halaman Daftar pembelian buyer
Route::get('/purchase/history', [TransactionController::class, 'buyerHistory'])->middleware('auth');
// Halaman Daftar pembelian buyer
Route::get('/purchase/records', [TransactionController::class, 'adminHistory'])->middleware('auth');
// Pembelian
Route::resource('/purchase', TransactionController::class)->middleware('auth');

// NOTIFICATION MANAGEMENT
// Notifikasi Buyer
Route::get('/notification', [NotificationController::class, 'buyerNotif'])->middleware('auth');
// Notifikasi Seller
Route::get('/notification/seller', [NotificationController::class, 'sellerNotif'])->middleware('auth');
