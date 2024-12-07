@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Form Checkout</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customer_name">Nama Pembeli</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>
<br>
        <div class="form-group">
            <label for="table_number">Nomor Meja</label>
            <input type="text" name="table_number" id="table_number" class="form-control" required>
        </div>
<br>
        <div class="form-group">
            <label for="packed"><b>Makan di Tempat atau Dibungkus?</b></label>
            <div>
                <label class="radio-inline">
                    <input type="radio" name="packed" value="1" required> Dibungkus
                </label>
                <br>
                <label class="radio-inline">
                    <input type="radio" name="packed" value="0" required> Makan di Tempat
                </label>
            </div>
        </div>
<br>
        <div class="form-group">
            <label for="special_requests">Permintaan Khusus (Contoh: Tidak pedas, tanpa daun bawang, dll.)
                <p><b>Note :</b> Jika tidak ada kosongkan</p>
            </label>
            <textarea name="special_requests" id="special_requests" class="form-control" rows="3"></textarea>
        </div>
<br>
        <button type="submit" class="btn btn-primary">Lanjutkan Checkout</button>
    </form>
</div>
@endsection
