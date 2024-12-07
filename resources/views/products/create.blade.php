
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

            <div class="mb-3">
                <label for="category" class="form-label">Kategori:</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <!-- Add space between buttons using ml-2 (margin-left) and icon to the cancel button -->
            <a href="{{ route('products.index') }}" class="btn btn-secondary ms-4">
                <i class="fas fa-times"></i> Batal
            </a>
        </form>
    </div>
</body>
</html>
