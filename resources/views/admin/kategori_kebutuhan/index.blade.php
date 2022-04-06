<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charitee | </title>
  </head>

  <body>
    <h2>List Kategori</h2>
    <a href="/admin/kategori/create">+</a>
    <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Ikon</th>
            <th class="text-center">Action</th>
          </tr>
          @foreach ($list_kategori as $kategori)
              <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $kategori->nama }}</td>
                  <td class="text-center"><img src="{{ asset('/storage/'.$kategori->ikon) }}" alt="{{ $kategori->ikon }}" height="100px" width="100px"></td>
                  <td class="text-center"> 
                    <a href="/admin/kategori/{{ $kategori->nama }}/edit" class="badge bg-info"><span data-feather="eye">Update</span></a>
                    <form action="/admin/kategori/{{ $kategori->nama }}" class="d-inline" method="POST">
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