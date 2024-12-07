<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-10" style="overflow-x: auto; height:100vh;">
                <h1 class="my-4">Daftar Produk</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </a>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold"></h1>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Home</a>

                </div>

                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kategori</th> <!-- Kolom Kategori Baru -->
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($product->category) }}</td> <!-- Menampilkan Kategori Produk -->
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        width="100px">
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
