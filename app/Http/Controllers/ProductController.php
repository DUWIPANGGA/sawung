<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = DB::table('products')->get();

        // Debug untuk melihat URL gambar
        foreach ($products as $product) {
            // Menampilkan URL gambar di log
            Log::info('URL Gambar: ' . Storage::url($product->image));
        }

        return view('products.index', compact('products'));
    }

    public function showMenu()
    {
        $products = Product::all(); // Fetch all products
        return view('menu', compact('products')); // Pass $products to the view
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Simpan gambar ke storage
        $imagePath = $request->file('image')->store('gambar', 'public');

        // Simpan data produk ke database
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('products.edit', compact('product'));
    }

    // Mengupdate produk
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah ada gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldImage = DB::table('products')->where('id', $id)->value('image');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }            

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak ada gambar baru, gunakan gambar yang lama
            $imagePath = DB::table('products')->where('id', $id)->value('image');
        }

        // Update produk di database
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    // Menghapus produk
    public function destroy($id)
    {
        // Ambil path gambar dari database
        $imagePath = DB::table('products')->where('id', $id)->value('image');

        // Hapus gambar dari storage jika ada
        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        // Hapus produk dari database
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
