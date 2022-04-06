@extends('layouts/main')

@section('container')
    <p><a class="text-decoration-none" href="/">Home</a> < Detail Donasi Barang</p>
    <p>ID Donasi Barang:{{ $donasi->id_donasi }}</p>
    @if($donasi->status_donasi == true)
        <p>Barang sudah sampai ke panti tujuan</p>
        <p>Terimakasih Sudah Berdonasi</p>
    @else
        <p>Barang masih belum terkirim</p>
    @endif
        <p>Kalau Ada Pertanyaan Jangan Sungkan Bertanya ke email humas@charitee.id atau via Whatsapp di Link Berikut</p>
        <a href="#">Bit.ly/KonfirmasiWA</a>
        <p>Anda Akan dihubungi via Whatsapp untuk Konfirmasi dan Informasi Ongkir</p>
@endsection