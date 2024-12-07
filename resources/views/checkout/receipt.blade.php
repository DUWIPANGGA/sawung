<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Pesanan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Optional: Link to Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Rincian Pesanan</h2>

                <p><strong>Nama Pembeli:</strong> {{ $order->customer_name }}</p>
                <p><strong>Nomor Meja:</strong> {{ $order->table_number }}</p>
                <p><strong>Tanggal Pesan:</strong> {{ \Carbon\Carbon::parse($order->order_date)->timezone('Asia/Jakarta')->format('d-m-Y') }}</p>
                <p><strong>Waktu Pesan:</strong> {{ \Carbon\Carbon::parse($order->order_date)->timezone('Asia/Jakarta')->format('H:i') }}</p>

                <!-- Status Packed (Dibungkus/Makan di Tempat) -->
                <p><strong>Status Pemesanan:</strong> 
                    @if ($order->packed)
                        Dibungkus
                    @else
                        Makan di Tempat
                    @endif
                </p>

                <!-- Special Requests -->
                <p><strong>Permintaan Khusus:</strong> {{ $order->special_requests ? $order->special_requests : 'Tidak ada' }}</p>

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

                <div class="d-flex justify-content-between mt-4">
                    <p class="font-weight-bold">Total Harga:</p>
                    <p class="font-weight-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>

                <!-- Tombol Cetak PDF -->
                <button id="print-button" class="btn btn-primary">Cetak PDF</button>
            </div>
        </div>
    </div>

    <!-- Optional: Include Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi cetak dan redirect
        document.getElementById('print-button').addEventListener('click', function () {
            window.print(); // Cetak halaman
            // Tunggu beberapa waktu untuk memastikan pencetakan selesai sebelum redirect
            setTimeout(function () {
                window.location.href = '/home'; // Arahkan ke home (atau URL lain)
            }, 2000); // Delay 2 detik
        });
    </script>
</body>
</html>
