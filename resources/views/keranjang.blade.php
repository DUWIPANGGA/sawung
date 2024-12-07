@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Keranjang Belanja</h2>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($keranjang))
        <p>Keranjang Anda kosong.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keranjang as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" height="70">
                        </td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" required>
                                <button type="submit" class="btn btn-sm btn-warning">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <strong>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>
            <a href="{{ route('checkout.form') }}" class="btn btn-success">Checkout</a>
        </div>
    @endif
</div>
@endsection