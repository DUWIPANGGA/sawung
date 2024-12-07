<?php 
use App\Http\Controllers\Api\OrderController;

Route::middleware('api')->prefix('orders')->group(function () {
    // Menyimpan pesanan baru
    Route::post('/', [OrderController::class, 'store']);

    // Menampilkan semua pesanan
    Route::get('/', [OrderController::class, 'index']);

    // Menampilkan detail pesanan
    Route::get('/{id}', [OrderController::class, 'show']);

    // Menghapus pesanan
    Route::delete('/{id}', [OrderController::class, 'destroy']);

    // Memperbarui status pembayaran
    Route::patch('/{id}/payment', [OrderController::class, 'updatePayment']);
});
