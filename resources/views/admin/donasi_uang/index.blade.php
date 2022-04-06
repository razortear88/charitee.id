<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charitee | </title>
  </head>

  <body>
    <h2>Edit Donasi Uang</h2>
    <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">ID</th>
            <th class="text-center">Panti</th>
            <th class="text-center">Nama Donatur</th>
            <th class="text-center">Jumlah Uang</th>
            <th class="text-center">Action</th>
          </tr>
          @foreach ($all_donasi as $donasi)
              <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $donasi->id_donasi }}</td>
                  <td class="text-center">{{ $donasi->nama_panti }}</td>
                  <td class="text-center">{{ $donasi->nama_donatur }}</td>
                  @php
                    $nominal_uang = number_format($donasi->jumlah_uang,0,',','.');
                  @endphp
                  <td class="text-center">{{ $nominal_uang }}</td>
                  <td class="text-center"> 
                    <a href="/admin/donasi-uang/{{ $donasi->id_donasi }}" class="badge bg-info"><span data-feather="eye">Detail</span></a>
                    <form action="/admin/donasi-uang/{{ $donasi->id_donasi }}" class="d-inline" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="badge bg-danger border-0" id="btn-delete-post" onclick="return confirm('are you sure to delete this?')"><span data-feather="x-circle"></span>Delete</button>
                    </form>
                  </td>
              </tr>
          @endforeach
        </thead>
        <tbody>
        </tbody>
      </table>
  </body>
</html>