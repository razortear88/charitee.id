@extends('layouts/main')

@section('container')
    <div id="carouselExampleIndicators" class="carousel slide" style="max-width: 300px; max-height: 125px" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" style="max-width: 300px; max-height: 125px" src="/img/aquarius.jpg" alt="First slide">
                <div class="carousel-caption">
                    <p class="px-3">Foto-foto kegiatan tahun lalu</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="max-width: 300px; max-height: 125px" src="/img/cancer.jpg" alt="Second slide">
                <div class="carousel-caption">
                    <p class="px-3">Foto-foto kegiatan tahun lalu</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="max-width: 300px; max-height: 125px" src="/img/libra.jpg" alt="Third slide">
                <div class="carousel-caption">
                    <p class="px-3">Foto-foto kegiatan tahun lalu</p>
                </div>
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>

    <p>Charitee.id memberikan kemudahan berdonasi secara cepat dan praktis dimanapun anda berada </p>

    <a href="/list-panti" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Pilih Panti Asuhan</a>

    <p>Setiap Donasi dari Anda, Adalah Kebahagiaan Anak Yatim</p>
    <p>Total Donasi Uang: Rp {{ $total_donasi_uang }}</p>
    <p>Total Donasi Barang: {{ $total_donasi_barang }}</p>
    <p>Total Donatur: {{ $total_donatur }}</p>


@endsection