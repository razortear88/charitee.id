<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charitee | </title>
  </head>

  <body>
      <p>ID: {{ $donasi->id_donasi }}</p>
      <p>Tujuan Panti: {{ $donasi->nama_panti }}</p>
      <p>Nama Donatur: {{ $donasi->nama_donatur }}</p>
      <p>Email Donatur: {{ $donasi->email_donatur }}</p>
      <p>Kontak Donatur: {{ $donasi->nomor_kontak_donatur }}</p>
      @php
        $nominal_uang = number_format($donasi->jumlah_uang,0,',','.');
      @endphp
      <p>Nominal Uang: {{ $nominal_uang }}</p>
      <form action="/admin/donasi-uang/set-status/{{ $donasi->id_donasi }}" method="POST">
        @csrf
          <button type="submit" onclick="return confirm('are you sure update this?')">Change Status</button>
      </form>
  </body>
</html>