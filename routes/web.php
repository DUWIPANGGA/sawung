<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemesanController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\OrderController;

// Route untuk halaman awal
Route::get('/', function () {
    return view('landing_page');
});

// Route untuk menu
Route::get('/menu', [ProductController::class, 'showMenu'])->name('menu');

// Menggunakan kontroler untuk keranjang
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');

// Resource route untuk produk
Route::resource('products', ProductController::class)->names([
    'index' => 'products.index',
    'create' => 'products.create',
    'store' => 'products.store',
    'edit' => 'products.edit',
    'update' => 'products.update',
    'destroy' => 'products.destroy',
]);

// Otentikasi
Auth::routes();

// Route untuk halaman setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// Route untuk keranjang
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [KeranjangController::class, 'index'])->name('index');
    Route::get('add/{id}', [KeranjangController::class, 'add'])->name('add');
    Route::get('remove/{id}', [KeranjangController::class, 'remove'])->name('remove');
    Route::post('update/{id}', [KeranjangController::class, 'update'])->name('update');
});

// Route untuk dashboard
Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard'); // Ganti dengan route admin
        } elseif ($user->role == 'pemesan') {
            return redirect()->route('pemesan.dashboard'); // Ganti dengan route pemesan
        }
    }

    return redirect('/'); // Redirect ke halaman utama jika tidak ada role
});

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auths');
Route::get('/admin/call', [AdminController::class, 'call'])->name('admin.call')->middleware('auths');

Route::resource('orders', OrderController::class);
Route::get('/pemesan/dashboard', [PemesanController::class, 'index'])->name('pemesan.dashboard');

Route::get('/pemesan/receipt', [PemesanController::class, 'receipt'])->name('pemesan.resip');
Route::get('/checkout/receipt', [CheckoutController::class, 'receipt'])->name('checkout.resip');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{order}/updatePayment', [OrderController::class, 'updatePayment'])->name('orders.updatePayment');
Route::patch('orders/{id}/paymadent', [OrderController::class, 'updatePayment']);




// Route Checkout

Route::middleware('admin')->group(function () {
// Route::middleware('admin')->group(function () {
    Route::post('/device', [DeviceController::class, 'store'])->name('device.add');
    Route::delete('/device/{id}', [DeviceController::class, 'destroy'])->name('device.delete');
    Route::put('/device', [DeviceController::class, 'edit'])->name('device.edit');
    Route::get('/device', [DeviceController::class, 'show'])->name('device.show');
// });
});
Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/receipt', [CheckoutController::class, 'receipt'])->name('checkout.receipt');
