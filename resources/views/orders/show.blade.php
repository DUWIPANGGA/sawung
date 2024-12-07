<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Detail Pesanan</h2>

                <p><strong>Nama Pembeli:</strong> {{ $order->customer_name }}</p>
                <p><strong>Nomor Meja:</strong> {{ $order->table_number }}</p>
                <p><strong>Tanggal Pesan:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                <!-- Menampilkan status packed -->
                <p><strong>Status Pemesanan</strong> 
                    @if ($order->packed)
                        <span class="text-success">Dibungkus</span>
                    @else
                        <span class="text-danger">Makan Di Tempat</span>
                    @endif
                </p>

                <!-- Menampilkan permintaan khusus -->
                @if ($order->special_requests)
                    <p><strong>Permintaan Khusus:</strong> {{ $order->special_requests }}</p>
                @else
                    <p><strong>Permintaan Khusus:</strong> Tidak ada permintaan khusus.</p>
                @endif

                <!-- Menampilkan status pembayaran -->
                <p><strong>Status Pembayaran:</strong> 
                    @if($order->payment_status == 'belum_bayar')
                        <span class="badge bg-danger">Belum Bayar</span>
                    @else
                        <span class="badge bg-success">Sudah Bayar</span>
                    @endif
                </p>

                <!-- Tombol untuk mengubah status pembayaran (untuk penjual) -->
                @if($order->payment_status == 'belum_bayar')
                    <form action="{{ route('orders.updatePayment', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">Tandai Sudah Bayar</button>
                    </form>
                @endif

                <table class="table table-bordered table-striped mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($order->items) as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
