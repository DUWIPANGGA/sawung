@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Tambah Produk</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama produk" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga:</label>
                <input type="text" name="price" id="price" class="form-control" placeholder="Masukkan harga produk" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar:</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
@endsection