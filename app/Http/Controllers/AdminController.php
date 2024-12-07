<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        $totalOrder = Order::all()->count();
        return view('admin.dashboard',compact('totalOrder')); // Pastikan Anda memiliki view ini
    }
    public function call(){
        $devices = Device::where('id_user','=',Auth::user()->id)->get();
        return view('admin.call',compact('devices'));
    }

    // Tambahkan metode lain sesuai kebutuhan
}