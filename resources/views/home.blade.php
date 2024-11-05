@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>
    .carousel-item img {
            height: 400px;
           
            object-fit: cover;
            
        }
</style>
</head>
<body>
    <main class="container mt-5">
        <div class="content">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('gambar/15.jpg') }}" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('gambar/14.jpg') }}" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('gambar/9.jpg') }}" class="d-block w-100" alt="Slide 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('gambar/12.jpg') }}" class="d-block w-100" alt="Slide 4">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('gambar/13.jpg') }}" class="d-block w-100" alt="Slide 5">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <br>
            <h3>Sawung Biung</h3>
            <p style="text-align: justify;">Sawung Biung terletak di Indramayu. Sawung Biung menawarkan hidangan khas daerah dengan cita rasa otentik.
                Menu kami mencakup berbagai pilihan makanan lokal yang memanjakan lidah Anda, dengan harga yang terjangkau.
                Suasana kedai ini didesain untuk menciptakan ruang yang santai dan ramah.</p>
            <p style="text-align: justify;">Dekorasi yang sederhana namun menarik menciptakan atmosfer yang hangat, cocok untuk pertemuan santai atau makan malam bersama teman.
                Tim Sawung Biung selalu siap melayani Anda dengan senyum dan keramahan.
                Kami berkomitmen untuk memberikan pengalaman pelanggan yang positif dan memastikan kenyamanan setiap tamu.</p>
            
            <div class="location-info">
                <h3>Kontak Kami </h3>
                <p><i class="bi bi-whatsapp"> (+62) 83148050378</i></p>
                <p><i class="bi bi-instagram"> Sawung_Biung123</i></p>
                <p><i class="bi bi-envelope-fill"> meli@gmail.com</i></p>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = document.getElementById('carouselExampleIndicators');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: false
            });

            myCarousel.addEventListener('slid.bs.carousel', function() {
                var activeIndex = carousel.getActiveIndex();
                var numItems = carousel.getInner().getElementsByClassName('carousel-item').length;

               
                if (activeIndex === numItems - 1) {
                    setTimeout(function() {
                        carousel.to(0);
                    }, 1000); 
                }
            });
        });
    </script>
</body>
</html>

@endsection
