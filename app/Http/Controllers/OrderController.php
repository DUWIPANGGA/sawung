<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request (nama pelanggan, nomor meja, items, packed, special_requests)
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|string|max:255',
            'items' => 'required|array',  // Pastikan items adalah array
            'packed' => 'required|boolean',  // Validasi packed (true/false)
            'special_requests' => 'nullable|string',  // Permintaan khusus yang bisa kosong
        ]);

        // Menghitung total harga berdasarkan item yang dipesan
        $total_price = 0;

        foreach ($request->items as $item) {
            // Periksa setiap item, pastikan ada harga dan kuantitas
            if (isset($item['price']) && isset($item['quantity'])) {
                $total_price += $item['price'] * $item['quantity'];  // Harga per item dikali kuantitas
            }
        }

        // Jika total harga tetap 0, berarti ada masalah dengan data item
        if ($total_price <= 0) {
            return back()->with('error', 'Total harga tidak valid. Pastikan semua item memiliki harga dan kuantitas.');
        }

        // Menyimpan data ke database
        $order = new Order();
        $order->customer_name = $request->customer_name;
        $order->table_number = $request->table_number;
        $order->total_price = $total_price;  // Menggunakan total harga yang dihitung
        $order->items = json_encode($request->items);  // Mengonversi array ke JSON
        $order->order_date = now();
        $order->packed = $request->packed;  // Menyimpan status packed
        $order->special_requests = $request->special_requests;  // Menyimpan permintaan khusus
        $order->save();

        // Menyimpan ID order ke session untuk digunakan di halaman checkout
        session(['order_id' => $order->id]);

        // Redirect ke halaman receipt
        return redirect()->route('checkout.receipt');
    }

    public function show($id)
{
    $order = Order::findOrFail($id);
    
    // Perbarui status pesanan menjadi 'Sudah Dilihat'
    if ($order->is_new) {
        $order->is_new = false;
        $order->save();
    }

    return view('orders.show', compact('order'));
}


    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get(); // Ambil semua pesanan, urutkan terbaru
        return view('orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Hapus pesanan
        $order->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
    public function updatePayment($orderId)
{
    $order = Order::findOrFail($orderId);
    $order->payment_status = 'sudah bayar';
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Pembayaran pesanan telah diperbarui.');
    return redirect()->route('orders.show', $id)->with('success', 'Pembayaran telah terverifikasi');
}


}
