<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahan CSS */
        body {
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: none;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
        }

        .alert-info strong {
            font-size: 1.1rem;
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-10" style="overflow-x: auto; height:100vh;">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold">Daftar Pesanan</h1>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Home</a>
                </div>

                <!-- Card -->
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Pesanan Masuk</h2>

                        @php
                            $newOrders = $orders->where('is_new', true)->count();
                        @endphp

                        <!-- Notifikasi Pesanan Baru -->
                        @if ($newOrders > 0)
                            <div class="alert alert-info text-center">
                                <strong>{{ $newOrders }} pesanan baru</strong> menunggu diproses!
                            </div>
                        @endif

                        <!-- Tabel Pesanan -->
                        <table class="table table-bordered table-striped mt-4">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Nomor Meja</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th> <!-- Kolom Pembayaran -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $index => $order)
                                    <tr class="{{ $order->is_new ? 'table-warning' : '' }}">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td class="text-center">{{ $order->table_number }}</td>
                                        <td class="text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if ($order->is_new)
                                                <span class="badge bg-warning text-dark">Baru</span>
                                            @else
                                                <span class="badge bg-success">Sudah Dilihat</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($order->payment_status == 'belum bayar')
                                                <span class="badge bg-danger">Belum Bayar</span>
                                            @else
                                                <span class="badge bg-success">Sudah Bayar</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-sm btn-primary">Detail</a>
                                            <form action="{{ route('orders.updatePayment', $order->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-info">Pembayaran</button>
                                            </form>
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
