@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    .product-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }

    .product-img {
    width: 100%;
    height: 200px; /* Try to set a fixed height for consistency */
    object-fit: cover;
}


    .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .card-title {
        font-size: 1.25em;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 1.1em;
        color: #777;
        margin-bottom: 20px;
    }

    .btn-outline-success {
        font-size: 1em;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: #fff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    h2, h3 {
        font-weight: bold;
        color: #444;
    }

    .category-btn {
        font-size: 1em;
        padding: 10px 20px;
        border-radius: 8px;
        margin: 5px;
        transition: background-color 0.3s;
    }

    .category-section {
        display: none;
    }

    .category-section.active {
        display: block !important;
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #003366);
        transform: scale(1.05);
    }
</style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Menu Produk</h2>
        <div class="text-center mb-5">
            <a href="{{ route('cart.index') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg border-0 transition-all hover:bg-primary hover:shadow-xl hover:scale-105">
                <i class="fas fa-shopping-cart me-2"></i> Lihat Keranjang
            </a>
        </div>
    
        <!-- Kategori Navigasi -->
        <div class="text-center mb-5">
            <button class="btn btn-outline-primary category-btn mx-2" onclick="showCategory('makanan')">Makanan</button>
            <button class="btn btn-outline-primary category-btn mx-2" onclick="showCategory('minuman')">Minuman</button>
        </div>
    
        <!-- Bagian Makanan -->
        <div id="makanan" class="category-section">
            <h3 class="mb-4">Makanan</h3>
            <div class="row justify-content-center">
                @if($foods->isEmpty())
                    <p class="text-center">Tidak ada makanan yang tersedia saat ini.</p>
                @else
                    @foreach($foods as $food)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                        <div class="card product-card">
                                <img src="{{ asset('storage/' . $food->image) }}" class="product-img" alt="{{ $food->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $food->name }}</h5>
                                    <p class="card-text">Rp {{ number_format($food->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('cart.add', $food->id) }}" class="btn btn-outline-success btn-block">Tambahkan ke Keranjang</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    
        <!-- Bagian Minuman -->
        <div id="minuman" class="category-section" style="display: none;">
            <h3 class="mt-5 mb-4">Minuman</h3>
            <div class="row justify-content-center">
                @if($drinks->isEmpty())
                    <p class="text-center">Tidak ada minuman yang tersedia saat ini.</p>
                @else
                    @foreach($drinks as $drink)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                        <div class="card product-card">
                                <img src="{{ asset('storage/' . $drink->image) }}" class="product-img" alt="{{ $drink->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $drink->name }}</h5>
                                    <p class="card-text">Rp {{ number_format($drink->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('cart.add', $drink->id) }}" class="btn btn-outline-success btn-block">Tambahkan ke Keranjang</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function showCategory(category) {
            // Hide all sections
            document.querySelectorAll('.category-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Display the selected category
            document.getElementById(category).style.display = 'block';
        }
    
        // Optional: Set the default view to 'makanan' or 'minuman'
        document.addEventListener("DOMContentLoaded", function() {
            showCategory('makanan'); // Menampilkan bagian makanan secara default
        });
    </script>

</body>
</html>
@endsection
