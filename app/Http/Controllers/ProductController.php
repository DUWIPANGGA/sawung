<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::all(); // Mengambil semua produk
        return view('products.index', compact('products'));
    }

    // Menampilkan menu produk, dengan kategori makanan dan minuman
    public function showMenu()
    {
        $foods = Product::where('category', 'makanan')->get(); // Mengambil produk kategori makanan
        $drinks = Product::where('category', 'minuman')->get(); // Mengambil produk kategori minuman
        
        // Mengirim data makanan dan minuman ke view 'menu'
        return view('menu', compact('foods', 'drinks'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi input, termasuk kategori
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category' => 'required|in:makanan,minuman', // Validasi category
        ]);

        // Simpan gambar ke storage
        $imagePath = $request->file('image')->storeAs(
            'images', // Folder penyimpanan
            $request->file('image')->getClientOriginalName(), // Nama file asli
            'public' // Disk
        );
                Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'category' => $request->category, // Menambahkan category
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Ambil produk berdasarkan ID
        return view('products.edit', compact('product'));
    }

    // Mengupdate produk
    public function update(Request $request, $id)
    {
        // Validasi input, termasuk kategori
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:makanan,minuman', // Validasi category
        ]);

        // Ambil produk yang akan di-update
        $product = Product::findOrFail($id);

        // Cek apakah ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->storeAs(
                'images', // Folder penyimpanan
                $request->file('image')->getClientOriginalName(), // Nama file asli
                'public' // Disk
            );        
        } else {
            // Jika tidak ada gambar baru, tetap gunakan gambar lama
            $imagePath = $product->image;
        }

        // Update produk dengan category
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'category' => $request->category, // Memperbarui category
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Ambil produk yang akan dihapus

        // Hapus gambar dari storage jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus produk dari database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}