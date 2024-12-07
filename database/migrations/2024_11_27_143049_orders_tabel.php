<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat atau memperbarui tabel 'orders'
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID order
            $table->string('customer_name'); // Nama pembeli
            $table->string('table_number'); // Nomor meja
            $table->text('items'); // Item yang dipesan (disimpan sebagai JSON)
            $table->decimal('total_price', 10, 2); // Total harga
            $table->timestamp('order_date'); // Tanggal dan waktu pemesanan
            $table->boolean('is_new')->default(true); // Menambahkan kolom is_new
            $table->boolean('packed')->default(false); // Kolom packed, default 'false' untuk makan di tempat
            $table->text('special_requests')->nullable(); // Kolom untuk mencatat permintaan khusus (seperti 'tidak pedas', 'tanpa daun bawang')
            $table->timestamps(); // Created at dan updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Menghapus tabel 'orders'
        Schema::dropIfExists('orders');
    }
};
