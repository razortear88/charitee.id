<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charitee | </title>
  </head>

  <body>
    <h2>List Panti</h2>
    <a href="/admin/panti/create">+</a>
    <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Kecamatan</th>
            <th class="text-center">Kota</th>
            <th class="text-center">Kontak</th>
            <th class="text-center">Action</th>
          </tr>
          @foreach ($all_panti as $panti)
              <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $panti->nama_panti }}</td>
                  <td class="text-center">{{ $panti->kecamatan }}</td>
                  <td class="text-center">{{ $panti->kota }}</td>
                  <td class="text-center">{{ $panti->nomor_kontak }}</td>
                  <td class="text-center"> 
                    <a href="/panti/{{ $panti->slug }}" class="badge bg-info"><span data-feather="eye">Detail</span></a>
                    <a href="/admin/panti/{{ $panti->slug }}/edit" class="badge bg-info"><span data-feather="eye">Update</span></a>
                    <form action="/admin/panti/{{ $panti->slug }}" class="d-inline" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="badge bg-danger border-0" id="btn-delete-post" onclick="return confirm('are you sure?')"><span data-feather="x-circle"></span>Delete</button>
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