<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WebProductController;
use App\Http\Controllers\WebProductsController;
use App\Http\Controllers\WebRegisterController;
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

// Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Login
Route::post('/login', [LoginController::class, 'authenticate']);
// Logout
Route::post('/logout', [LoginController::class, 'logout']);

// Halaman Register
Route::get('/register', [WebRegisterController::class, 'index'])->middleware('guest');
// Registrasi User
Route::post('/register', [WebRegisterController::class, 'store']);

// Profile User
Route::put('/profile/image/{user:username}', [ProfileController::class, 'updateImage'])->middleware('auth');
// Profile User
Route::resource('/profile', ProfileController::class)->scoped(['user' => 'username'])->middleware('auth');

// checkSlug
Route::get('/admin/product/checkSlug', [WebProductsController::class, 'checkSlug'])->middleware('auth');
// Admin Controller
Route::resource('/admin/product', AdminProductController::class)->scoped(['product' => 'slug'])->middleware('auth');

// Haaman semua produk
Route::get('/products', [WebProductController::class, 'index']);

// Halaman detail produk
Route::get('products/{product:slug}', [WebProductController::class, 'show']);

// Halaman pembelian
Route::get('/purchase/product/{product:slug}', [WebProductController::class, 'purchase'])->middleware('auth');

// Halaman Daftar pembelian buyer
Route::get('/purchase/offers', [TransactionController::class, 'buyerOffers'])->middleware('auth');
// Halaman Daftar pembelian buyer
Route::get('/purchase/history', [TransactionController::class, 'buyerHistory'])->middleware('auth');
// Halaman Daftar pembelian buyer
Route::get('/purchase/records', [TransactionController::class, 'adminHistory'])->middleware('auth');
// Pembelian
Route::resource('/purchase', TransactionController::class)->middleware('auth');

// Notifikasi Buyer
Route::get('/notification', [NotificationController::class, 'buyerNotif'])->middleware('auth');
// Notifikasi Seller
Route::get('/notification/seller', [NotificationController::class, 'sellerNotif'])->middleware('auth');

// // dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

// Route::get('/dashboard/products/checkSlug', [WebProductsController::class, 'checkSlug'])->middleware('auth');

// Route::resource('/dashboard/products', WebProductsController::class)->scoped(['product' => 'slug'])->middleware('auth');

// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

// Halaman produk per kategory
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('products', [
//         'title' => "Produk dengan kategori : $category->category_name",
//         "active" => 'categories',
//         'products' => $category->products->load('category', 'user'),
//     ]);
// });

// Halama produk per producer
// Route::get('/producer/{user:username}', function (User $user) {
//     return view('products', [
//         'title' => "Produk buatan produsen : $user->name",
//         "active" => 'products',
//         'products' => $user->products->load('category', 'user'),
//     ]);
// });
