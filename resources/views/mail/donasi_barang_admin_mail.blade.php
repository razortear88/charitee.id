@component('mail::message')
    <h3>Detail Donasi</h3>
    <p>Donasi barang atas nama {{ $detail_donasi_barang['nama_donatur'] }} untuk panti {{ $detail_donasi_barang['nama_panti'] }}</p>
    <p>Nomor Kontak: {{ $detail_donasi_barang['nomor_kontak_donatur'] }}</p>
    @component('mail::button', ['url' => $detail_donasi_barang['url']])
    Halaman Donasi
    @endcomponent
@endcomponent