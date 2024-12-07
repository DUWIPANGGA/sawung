<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class KeranjangController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        // Ambil data produk dari sesi keranjang
        $keranjang = session()->get('keranjang', []);

        // Hitung total harga produk di keranjang
        $totalHarga = array_reduce($keranjang, function($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);

        return view('keranjang', compact('keranjang', 'totalHarga'));
    }

    // Menambahkan produk ke keranjang
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID

        // Ambil data keranjang yang sudah ada di sesi, jika tidak ada, buat array kosong
        $keranjang = session()->get('keranjang', []);

        // Jika produk sudah ada di keranjang, tambahkan jumlahnya
        if (isset($keranjang[$id])) {
            $keranjang[$id]['quantity']++;
        } else {
            // Jika produk belum ada di keranjang, tambahkan produk baru
            $keranjang[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image
            ];
        }

        // Simpan kembali data keranjang ke dalam sesi
        session()->put('keranjang', $keranjang);

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        // Ambil data keranjang yang sudah ada di sesi
        $keranjang = session()->get('keranjang', []);

        // Jika produk ada di keranjang, hapus produk tersebut
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang); // Simpan kembali ke sesi
        }

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    // Mengupdate jumlah produk di keranjang
    public function update(Request $request, $id)
    {
        // Ambil data keranjang yang sudah ada di sesi
        $keranjang = session()->get('keranjang', []);

        // Jika produk ada di keranjang, perbarui jumlahnya
        if (isset($keranjang[$id])) {
            // Validasi input jumlah produk (misalnya tidak boleh kurang dari 1)
            $quantity = $request->input('quantity', 1);
            $keranjang[$id]['quantity'] = max($quantity, 1); // Pastikan jumlahnya minimal 1

            session()->put('keranjang', $keranjang); // Simpan kembali ke sesi
        }

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui');
    }
}