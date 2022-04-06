@component('mail::message')
    <h3>Detail Donasi</h3>
    <p>Donasi atas nama {{ $detail_donasi_uang['nama_donatur'] }} dengan nominal Rp. {{ $detail_donasi_uang['jumlah_uang'] }},- untuk panti {{ $detail_donasi_uang['nama_panti'] }}</p>
    <p>Nomor Kontak: {{ $detail_donasi_uang['nomor_kontak_donatur'] }}</p>
    @component('mail::button', ['url' => $detail_donasi_uang['url']])
    Detail Donasi
    @endcomponent
@endcomponent