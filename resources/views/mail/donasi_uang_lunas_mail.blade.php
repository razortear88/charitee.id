@component('mail::message')
<p>Donasi uang sebesar Rp.{{ $detail_donasi_uang['jumlah_uang'] }},- telah kami terima.</p>
<p>Terimakasih atas kepeduliannya terhadap panti {{ $detail_donasi_uang['nama_panti'] }}.</p>
@endcomponent