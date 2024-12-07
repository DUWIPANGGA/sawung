<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->enum('payment_status', ['belum bayar', 'sudah bayar'])->default('belum bayar');
    });
    // DB::insert('insert into users (name, email, password,role) values (?,?,?,?)', ['Sawung Biung','biungbiung@gmail.com', bcrypt('adminkita')],'Sawung Biung');
    // DB::insert('insert into users (name, email, password,role) values (?,?,?,?)', ['admin kita','admin@adminkita.com', bcrypt('adminkita')],'admin');
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
