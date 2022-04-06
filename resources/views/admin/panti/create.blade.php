<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charitee | </title>
    <link rel="stylesheet" href="/css/style.css">
  </head>

  <body>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Panti</h1>
    </div>
<div class="col-lg-8">
    <form method="POST" action="/admin/panti" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_panti">Nama</label>
            <input type="text" class="form-control @error('nama_panti') is-invalid @enderror" name="nama_panti" id="nama_panti" value="{{ old('nama_panti') }}" required>
            @error('nama_panti')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}"  required readonly>
            @error('slug')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required>
            @error('lokasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>        

        <div class="form-group mb-3">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}" required>
            @error('kecamatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>        

        <div class="form-group mb-3">
            <label for="kota">Kota</label>
            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota" value="{{ old('kota') }}" required>
            @error('kota')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>        

        <div class="form-group mb-3">
            <label for="informasi">Informasi</label><br>
            <textarea id="informasi" class="form-control"  name="informasi" placeholder="Informasi" style="height: 125px;" required>{{ old('informasi') }}</textarea>
            
            @error('informasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>       

        <div class="form-group mb-3">
            <label for="kebutuhan">Kebutuhan</label><br>
            <textarea id="kebutuhan" class="form-control"  name="kebutuhan" placeholder="Kebutuhan" style="height: 125px;" required>{{ old('kebutuhan') }}</textarea>
            
            @error('kebutuhan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>       

        <div class="form-group mb-3">
            <label for="jumlah_anak">Jumlah Anak</label>
            <input type="text" class="form-control @error('jumlah_anak') is-invalid @enderror" name="jumlah_anak" id="jumlah_anak" value="{{ old('jumlah-anak') }}" required>
            @error('jumlah_anak')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>        

        <div class="form-group mb-3">
            <label for="nomor_kontak">Nomor Kontak</label>
            <input type="tel" pattern="[0-9]+" class="form-control @error('nomor_kontak') is-invalid @enderror" name="nomor_kontak" id="nomor_kontak" value="{{ old('nomor-kontak') }}" required>
            @error('nomor_kontak')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <p>List Kategori</p>
        @foreach($list_kategori as $kategori)
            <input type="checkbox" name="kategori-{{ $kategori->slug }}" id="kategori-{{ $kategori->slug }}">
            <span>{{ $kategori->nama }}</span>
        @endforeach

        <div class="mb-3">
            <label class="form-label" for="Gambar">Gambar</label>
            <div id="preview"></div>
            <input type="file" multiple onchange="previewImage()" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar[]">
            @error('gambar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Tambah Panti</button>
    </form>
</div>

<script src="/js/script.js"></script>
  </body>
</html>