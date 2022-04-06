@extends('layouts/main')

@section('container')
    <p><a class="text-decoration-none" href="/">Home</a> < Pilih Panti</p>
    <p>Pilih Panti Asuhan Berdasarkan Kebutuhannya:</p> 
    <p>Filter:</p>
    <form action="" method="POST">
    <div class="filter-kategori">
        @foreach($list_kategori as $kategori)
            <input type="checkbox" name="kategori-{{ $kategori->slug }}" id="kategori-{{ $kategori->slug }}">
            <span>{{ $kategori->nama }}</span>
        @endforeach
    </div>
    <button type="submit">Terapkan</button>
    </form>
    
    <p>Hasil:</p>
    @foreach($list_panti as $panti)
        @php
            $foto_panti = json_decode($panti->daftar_foto)[0];
        @endphp
        <table>
        <td>
            <img src="{{ asset('/storage/panti-gambars/'.$foto_panti) }}" width="100" height="100"  alt="{{ $panti->nama_panti }}">
        </td>
        </table>
        <a href="/panti/{{ $panti->slug }}">{{ $panti->nama_panti }}</a>
        <p> Kec. {{ $panti->kecamatan }},{{ $panti->kota }}</p>
        <p>Kebutuhan:</p>
        @php
            $list_kategori = json_decode($panti->daftar_kategori_kebutuhan);
        @endphp
        <table>
            @foreach( $list_kategori as $kategori)
                <td class="d-inline">
                    <img src="{{ asset('/storage/kategori_kebutuhan-ikons/'.$kategori.'.png') }}" height="20" width="20" alt="{{ $kategori }}">
                </td>
            @endforeach
        </table><br><br>
    @endforeach

@endsection