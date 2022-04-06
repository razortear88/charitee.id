@component('mail::message')
    <h3>Detail Donasi</h3>
    <p>Nama: {{ $detail_donasi_uang['nama_donatur']}}</p>
    <p>Nomor Kontak: {{ $detail_donasi_uang['nomor_kontak_donatur'] }}</p>
    <p>Nominal Uang: Rp.{{ $detail_donasi_uang['jumlah_uang'] }},-</p>
    <p>Tujuan Panti: {{ $detail_donasi_uang['nama_panti'] }}</p>
    @component('mail::button', ['url' => $detail_donasi_uang['url']])
    Detail Donasi
    @endcomponent
@endcomponent