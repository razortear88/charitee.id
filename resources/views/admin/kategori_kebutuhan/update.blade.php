<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charitee | </title>
  </head>

  <body>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Update New Kategori</h1>
    </div>
<div class="col-lg-8">
    <form method="POST" action="/admin/kategori/{{ $kategori->nama }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama_kategori" value="{{ old('nama') ?? $kategori->nama}}" required>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') ?? $kategori->slug}}"  required readonly>
            @error('slug')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div><br>

        <div class="mb-3">
            <label class="form-label" for="ikon">Ikon</label>
            <img class="img-fluid img-preview mb-3 col-sm-5">
            <input type="file" onchange="previewImage()" class="form-control @error('ikon') is-invalid @enderror" id="ikon" name="ikon">
            @error('ikon')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Kategori</button>
    </form>
</div>
<script src="/js/kategoriKebutuhan.js"></script>

<script>

    function previewImage(){
        const image = document.querySelector('#ikon');
        const imagePreview = document.querySelector('.img-preview');

        imagePreview.style.display = 'block';
        imagePreview.style.height = '100px';
        imagePreview.style.width = '100px';


        const oFReader= new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imagePreview.src = oFREvent.target.result;
        }
    }
</script>
  </body>
</html>