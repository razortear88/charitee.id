@extends('layouts/main')

@section('container')
    <p><a class="text-decoration-none" href="/">Home</a> < Detail Donasi Uang</p>
    <p>ID Donasi Uang:{{ $donasi->id_donasi }}</p>
    @php
        $nominal_uang = number_format($donasi->jumlah_uang,0,',','.');
    @endphp
    @if($donasi->status_donasi == true)
        Pembayaran sebesar Rp {{ $nominal_uang }},- telah berhasil dilakukan
    @else
    
    <p>Total Donasi anda sebesar:</p>
    
        <p>Rp {{ $nominal_uang }},-</p>
    <p>Silahkan Lakukan Pembayaran via Rekening Berikut</p>
    <p>13321234234</p>
    <p>BNI atas nama Fusi Foundation</p>
    @endif
    
    <a href="#">Bit.ly/KonfirmasiWA</a>
    <p>Silahkan Konfirmasi Pembayaran Anda via Whatsapp atau klik link di atas</p>

@endsection