<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;  // Pastikan model Order sudah ada

class CheckoutController extends Controller
{
    public function form()
    {
        // Ambil data keranjang dari session
        $keranjang = Session::get('keranjang', []);
        $totalHarga = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $keranjang));

        return view('checkout.form', compact('keranjang', 'totalHarga'));
    }

    public function store(Request $request)
    {
        // Validasi data pembeli, nomor meja, packed, dan special_requests
        $request->validate([
            'table_number' => 'required|string',
            'customer_name' => 'required|string',
            'packed' => 'required|boolean',  // Pastikan 'packed' adalah boolean
            'special_requests' => 'nullable|string',  // Permintaan khusus boleh kosong
        ]);

        // Ambil data keranjang dari session
        $keranjang = Session::get('keranjang', []);

        // Simpan transaksi atau order baru ke database
        $order = new Order();  // Pastikan sudah ada model Order
        $order->customer_name = $request->input('customer_name');
        $order->table_number = $request->input('table_number');
        $order->total_price = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $keranjang));
        $order->items = json_encode($keranjang);  // Menyimpan item dalam format JSON
        $order->order_date = now();  // Menyimpan waktu pemesanan
        $order->packed = $request->input('packed');  // Menyimpan status packed
        $order->special_requests = $request->input('special_requests', '');  // Menyimpan permintaan khusus
        $order->save();

        // Simpan ID order di session untuk digunakan di halaman receipt
        Session::put('order_id', $order->id);

        // Hapus keranjang setelah checkout
        Session::forget('keranjang');

        // Redirect ke halaman yang menunjukkan detail pesanan
        return redirect()->route('checkout.receipt');
    }

    public function receipt()
    {
        // Ambil data order dari database menggunakan order_id yang disimpan di session
        $order = Order::find(session('order_id'));

        // Pastikan order ditemukan, jika tidak redirect ke halaman lain
        if (!$order) {
            return redirect()->route('menu')->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('checkout.receipt', compact('order'));
    }

    public function resip()
    {
        return view('pemesan.resip');
    }
}
