<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman awal
Route::get('/', function () {
    return view('landing_page');
});

// Route untuk menu
Route::get('/menu', [ProductController::class, 'showMenu'])->name('menu');

// Menggunakan kontroler untuk keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
Route::get('/products/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');

// Resource route untuk produk
Route::resource('products', ProductController::class)->names([
    'index' => 'products.index',
    'create' => 'products.create',
    'store' => 'products.store',
    'edit' => 'products.edit',
    'update' => 'products.update',
    'destroy' => 'products.destroy',
]);

// Route login
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Route register
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Otentikasi
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
