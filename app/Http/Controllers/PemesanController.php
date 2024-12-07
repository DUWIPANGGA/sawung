<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesanController extends Controller
{
    // Menampilkan dashboard pemesan
    public function index()
    {
        return view('pemesan.dashboard'); // Pastikan Anda memiliki view ini
    }

    // Tambahkan metode lain sesuai kebutuhan
}