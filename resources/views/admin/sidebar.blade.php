
<div class="col-md-2 bg-dark text-white">
    <h4 class="text-center mt-4">Admin Dashboard</h4>
    <ul class="nav flex-column mt-5">
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('orders.index') }}">Lihat Pesanan</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('products.index') }}">Produk</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.call') }}">Panggil</a></li>
        
        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#settingsMenu" role="button" aria-expanded="false" aria-controls="settingsMenu">
                Pengaturan
            </a>
            <div class="collapse mt-2" id="settingsMenu">
                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">Logout</button>
                </form>
            </div>
        </li>
        
        
    </ul>
</div>