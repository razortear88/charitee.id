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
      <p>Alamat Barang: {{ $donasi->alamat_barang }}</p>
      <p>Keterangan Barang: {{ $donasi->keterangan_barang }}</p>
      <p>Berat Barang: {{ $donasi->berat_barang }} kg</p>
      <form action="/admin/donasi-barang/set-status/{{ $donasi->id_donasi }}" method="POST">
        @csrf
          <button type="submit">Change Status</button>
      </form>
  </body>
</html>