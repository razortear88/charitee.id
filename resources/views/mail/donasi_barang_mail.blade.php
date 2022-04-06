@component('mail::message')
    <h3>Detail Donasi</h3>
    <p>Nama: {{ $detail_donasi_barang['nama_donatur'] }}</p>
    <p>Nomor Kontak: {{ $detail_donasi_barang['nomor_kontak_donatur'] }}</p>
    <p>Alamat Barang: {{ $detail_donasi_barang['alamat_barang'] }},-</p>
    <p>Keterangan Barang: {{ $detail_donasi_barang['keterangan_barang'] }},-</p>
    <p>Berat Barang: {{ $detail_donasi_barang['berat_barang'] }}kg</p>
    @component('mail::button', ['url' => $detail_donasi_barang['url']])
    Halaman Donasi
    @endcomponent
@endcomponent
