<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        $doneOrder = Order::where("is_new", "0")->count();
        $successOrder = Order::where("payment_status", "sudah bayar")->count();
        $pendingOrder = Order::where("is_new", "1")->count();
        $totalOrder = Order::all();
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $topCustomer = Order::select('customer_name', DB::raw('COUNT(id) as total_orders'))
            ->groupBy('customer_name')
            ->orderBy('total_orders', 'desc')
            ->get();
        return view('admin.dashboard', compact(['totalOrder', 'pendingOrder', 'doneOrder', 'successOrder', 'orders', 'dailyOrders','topCustomer']));
    }
    public function call()
    {
        $devices = Device::where('id_user', '=', Auth::user()->id)->get();
        return view('admin.call', compact('devices'));
    }

    // Tambahkan metode lain sesuai kebutuhan
}
