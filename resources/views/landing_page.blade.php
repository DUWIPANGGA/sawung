<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Pemesanan Barcode</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header -->
    <header class="header" style="background-image: url('{{ asset('gambar/page.png') }}');">
        <div class="container">
            <h1>Pemesanan Cepat dengan Barcode di Saung Biung</h1>
            <p>Solusi pemesanan digital untuk pengalaman lebih praktis</p>
            <a href="/login" class="btn-primary">Daftar Sekarang</a>
        </div>
    </header>
    

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2>Pengalaman Pemesanan yang Mudah dan Cepat</h2>
            <p>Sawung Biung terletak di Indramayu. Rumah makan ini menawarkan hidangan khas daerah dengan cita rasa otentik. Menu kami mencakup berbagai pilihan makanan lokal yang memanjakan lidah Anda, dengan harga yang terjangkau. 
                Suasana kedai ini didesain untuk menciptakan ruang yang santai dan ramah. 
                Dekorasi yang sederhana, namun menarik menciptakan atmosfer yang hangat, cocok untuk pertemuan santai atau makan malam bersama teman. 
                Tim Kedai Cantik selalu siap melayani Anda dengan senyum dan keramahan. Kami berkomitmen untuk memberikan pengalaman pelanggan yang positif dan memastikan kenyamanan setiap tamu.</p>
            <br>
            <h3>Jam Buka</h3>
            <p>07.00 - 22.00 WIB</p>
            </div>
    </section>

    <!-- Fitur -->
    <section class="features">
        <h2>Pemesanan</h2>
        <div class="features-list">
            <div class="feature-item">
                <img src="{{ asset('gambar/barcode.jpeg') }}" alt="Scan Barcode">
                <p>Scan Barcode yang sudah disediakan</p>
            </div>
            <div class="feature-item">
                <img src="{{ asset('gambar/bayar.png') }}" alt="Order Confirmation">
                <p>Setelah pemesanan berhasil, lakukan bayar terlebih dahulu</p>
            </div>
            <div class="feature-item">
                <img src="{{ asset('gambar/notif.png') }}" alt="Wireless Bell">
                <p>Pembeli mendapat alat berupa wireless bell</p>
            </div>
            <div class="feature-item">
                <img src="{{ asset('gambar/siap.png') }}" alt="Notification">
                <p>Alat bunyi menandakan makanan sudah matang dan pembeli siap mengambilnya</p>
            </div>
        </div>
    </section>

    <section class="gallery">
        <h2>Menu & Suasana</h2>
        <div class="gallery-images">
            <img src="{{ asset('gambar/jeruk.jpg') }}" alt="Suasana 1">
            <img src="{{ asset('gambar/kwetiau.jpg') }}" alt="Suasana 2">
            <img src="{{ asset('gambar/nasi.jpg') }}" alt="Suasana 3">
            <img src="{{ asset('gambar/melon.jpg') }}" alt="Suasana 4">
            <img src="{{ asset('gambar/mangga.jpg') }}" alt="Suasana 5">
            <img src="{{ asset('gambar/naga.jpeg') }}" alt="Suasana 6">
        </div>
        <br>
        <div class="gallery-images">
            <img src="{{ asset('gambar/13.jpg') }}" alt="Suasana 1">
            <img src="{{ asset('gambar/12.jpg') }}" alt="Suasana 2">
            <img src="{{ asset('gambar/8.jpg') }}" alt="Suasana 3">
            <img src="{{ asset('gambar/14.jpg') }}" alt="Suasana 4">
            <img src="{{ asset('gambar/4.jpg') }}" alt="Suasana 5">
            <img src="{{ asset('gambar/9.jpg') }}" alt="Suasana 6">
        </div>
    </section>

    <!-- Call to Action -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4>DOOGEE</h4>
                <ul>
                    <li><a href="#">Teardown</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Partners</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Terms of Use</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Social</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">YouTube</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Service</h4>
                <ul>
                    <li><a href="#">Compare</a></li>
                    <li><a href="#">Download</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Bug Report</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Activity</h4>
                <ul>
                    <li><a href="#">Influencers</a></li>
                    <li><a href="#">Affiliate</a></li>
                    <li><a href="#">Co-branding</a></li>
                    <li><a href="#">Honor</a></li>
                    <li><a href="#">Giveaway</a></li>
                </ul>
            </div>
            <div class="footer-section newsletter">
                <h4>Newsletter Subscription</h4>
                <form>
                   <input type="email" placeholder="Email Anda" required>
            <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        <p class="footer-copyright">&copy; 2024 Sawung Biung. All rights reserved.</p>
    </footer>
      

</body>
</html>
