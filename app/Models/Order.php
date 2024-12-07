<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan plural dari nama model
    protected $table = 'orders';

    // Menentukan kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'customer_name',
        'table_number',
        'items',
        'total_price',
        'order_date',
        'is_new',
        'packed',
        'special_requests',
    ];

    // Menentukan kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'order_date' => 'datetime', // Kolom order_date di-cast ke tipe data datetime
        'items' => 'array', // Kolom items akan di-cast ke array (karena disimpan dalam format JSON)
    ];

    // Jika ingin menambahkan metode khusus untuk manipulasi data, bisa ditambahkan di sini
}
