<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Fungsi untuk menambahkan produk ke keranjang
    public function addToCart($productId)
    {
        // Cek apakah user login
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu untuk menambahkan produk ke keranjang.');
        }

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($productId);

        // Cek jika item sudah ada di keranjang
        $cartItem = CartItem::where('user_id', $userId)
                             ->where('product_id', $productId)
                             ->first();

        if ($cartItem) {
            // Jika item sudah ada, tambahkan kuantitas
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika item belum ada, buat item baru
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Fungsi untuk menampilkan isi keranjang
    public function viewCart()
    {
        $userId = Auth::id();
        $cartItems = CartItem::where('user_id', $userId)->with('product')->get();

        return view('keranjang', compact('cartItems'));
    }
}