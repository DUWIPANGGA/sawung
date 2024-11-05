<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class KeranjangController extends Controller
{
    public function index(): View
    {
        return view('keranjang');
    }
}
