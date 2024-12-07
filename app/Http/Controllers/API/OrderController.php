<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'required|string|max:255',
            'items' => 'required|array',
            'packed' => 'required|boolean',
            'special_requests' => 'nullable|string',
        ]);

        $total_price = 0;

        foreach ($request->items as $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $total_price += $item['price'] * $item['quantity'];
            }
        }

        if ($total_price <= 0) {
            return response()->json(['error' => 'Total harga tidak valid. Pastikan semua item memiliki harga dan kuantitas.'], 400);
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_price' => $total_price,
            'items' => json_encode($request->items),
            'order_date' => now(),
            'packed' => $request->packed,
            'special_requests' => $request->special_requests,
        ]);

        return response()->json(['message' => 'Pesanan berhasil dibuat', 'order' => $order], 201);
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);

        if ($order->is_new) {
            $order->is_new = false;
            $order->save();
        }

        return response()->json($order);
    }

    // Menampilkan semua pesanan
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    // Menghapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus']);
    }

    // Memperbarui status pembayaran
    public function updatePayment($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->payment_status = 'sudah bayar';
        $order->save();

        return response()->json(['message' => 'Pembayaran pesanan telah diperbarui']);
    }
}
