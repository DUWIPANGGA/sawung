@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
    <style>
        .custom-img {
            width: 100%;
            height: 150px; /* Tetapkan tinggi tetap untuk gambar */
            object-fit: cover; /* Memastikan gambar tidak pecah */
        }

        .card {
            width: 100%; /* Memanfaatkan lebar penuh kolom */
            max-width: 300px; /* Atur lebar maksimum */
            height: 400px; /* Tetapkan tinggi tetap untuk semua card */
            border: 1px solid #ccc; /* Border abu-abu */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan */
            border-radius: 8px; /* Sudut melengkung */
            margin: 10px; /* Jarak antar card */
            display: flex;
            flex-direction: column; /* Atur arah konten ke kolom */
            justify-content: space-between; /* Menjaga jarak antar elemen */
            transition: transform 0.2s ease; /* Efek hover */
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Pusatkan teks */
            justify-content: space-between; /* Jaga jarak antar elemen */
            text-align: center;
            flex-grow: 1; /* Mengisi ruang yang tersisa */
        }

        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            margin: 10px 0;
        }

        .card-text {
            font-size: 1em;
            margin: 10px 0;
            color: #555;
        }

        .card:hover {
            transform: scale(1.05); /* Efek hover */
        }

        .row {
            display: flex;
            flex-wrap: wrap; /* Memungkinkan wrapping pada baris */
            justify-content: center; /* Pusatkan card dalam baris */
        }

        .col-md-3 {
            display: flex;
            justify-content: center; /* Pusatkan card dalam kolom */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="custom-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('keranjang') }}" class="btn btn-primary">Keranjang</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection
