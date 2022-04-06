@extends('layouts/main')

@section('container')
    @php
        $daftar_foto = json_decode($panti->daftar_foto);
    @endphp
    <p><a class="text-decoration-none" href="/">Home</a> < <a class="text-decoration-none" href="/list-panti">Pilih Panti</a> < {{ $panti->nama_panti }}</p>

    <h2>Panti {{ $panti->nama_panti }}</h2>

    <div id="carouselExampleIndicators" class="carousel slide" style="max-width: 300px; max-height: 125px" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            @for($i = 1; $i < count($daftar_foto); $i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
            @endfor
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" style="max-width: 300px; max-height: 125px" src="{{ asset('/storage/panti-gambars/'.$daftar_foto[0]) }}" alt="{{ $daftar_foto[0] }}">
            </div>
            @for($i = 1; $i < count($daftar_foto); $i++)
                <div class="carousel-item">
                    <img class="d-block w-100" style="max-width: 300px; max-height: 125px" src="{{ asset('/storage/panti-gambars/'.$daftar_foto[$i]) }}" alt="{{ $daftar_foto[$i] }}">                    
                </div>
            @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>

    <div>
        <span class="text--dark-gray d-inline-block align-middle small mr-2">Bagikan:</span>
            <div class="d-inline-block">
                <a href="https://api.whatsapp.com/send/?text={{ env("APP_URL") }}/panti/{{ $panti->slug }}"><i class="bi bi-whatsapp"></i></a>
                <a href="https://facebook.com/sharer/sharer.php?u={{ env("APP_URL") }}/panti/{{ $panti->slug }}"><i class="bi bi-facebook"></i></a>
            </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_donasi_uang">Donasi Uang</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal_donasi_barang">Kirim Barang</button>

    <div>
        <span>Lokasi:{{ $panti->lokasi }}</span>
        <h2 class="font-weight-bold">Deskripsi</h2>
        <h4>{{ $panti->deskripsi }}</h4>
        <span>Informasi Panti</span>
        <p>{{ $panti->informasi }}</p>
        <span>Kebutuhan</span>
        <p>{{ $panti->kebutuhan }}</p>
        <div class="row mb-3">
            <div class="col">
                Jumlah Anak Asuh:
                <div>{{ $panti->jumlah_anak }} anak</div>
            </div>
            <div class="col">
                Total Donatur
                <div>{{ $panti->total_donatur }} orang</div>
            </div>
        </div>
        @php
            $nominal_uang = number_format($total_pendapatan_terakhir,0,',','.');
        @endphp
        <div class="row mb-3">
            <div class="col">
                Total Donasi Uang (3 Bulan Terakhir)
                <div>Rp {{ $nominal_uang }},-</div>
            </div>
            <div class="col">
                Total Donasi Barang
                <div>{{ $panti->total_donasi_barang }} donasi</div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                Kontak
                <div>{{ $panti->nomor_kontak }}</div>
            </div>
            
        </div>
    </div>
    
    <!-- Large modal -->

    <div class="modal fade modal_donasi_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <p>Silahkan isi Form Berikut</p>
            <form action="/donasi-barang" method="POST">
                @csrf
                <div class="form-floating">
                    <input id="inputNama" type="text" class="form-control @error('nama_donasi_barang') is-invalid @enderror" name="nama_donasi_barang" placeholder="nama" value="{{ old('nama_donasi_barang') }}" required autofocus>
                    <label for="inputNama">Nama</label>  
                    @error('nama_donasi_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <input type="hidden" name="tujuan_panti_donasi_barang" id="tujuan_panti" value="{{ $panti->nama_panti }}">

                <div class="form-floating">
                    <input id="inputEmail" type="email" class="form-control @error('email_donasi_barang') is-invalid @enderror" name="email_donasi_barang" placeholder="email" value="{{ old('email_donasi_barang') }}" required>
                    <label for="inputEmail">Email</label>  
                    @error('email_donasi_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input id="inputAlamatLokasiBarang" type="text" class="form-control @error('lokasi_donasi_barang') is-invalid @enderror" name="lokasi_donasi_barang" placeholder="Alamat Lokasi Barang" value="{{ old('lokasi_donasi_barang') }}" required>
                    <label for="inputAlamatLokasiBarang">Alamat Lokasi Barang</label>  
                    @error('lokasi_donasi_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input id="inputNomorWhatsapp" type="tel" pattern="[0-9]+" class="form-control  @error('nomor_donasi_barang') is-invalid @enderror" name="nomor_donasi_barang" placeholder="nomor" value="{{ old('nomor_donasi_barang') }}" required>
                    <label for="inputNomorWhatsapp">Nomor Whatsapp</label>  
                    @error('email_donasi_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input id="berat_donasi_barang" type="number" step="0.1" class="form-control  @error('berat_donasi_barang') is-invalid @enderror" name="berat_donasi_barang" placeholder="nomor" value="{{ old('berat_donasi_barang') ?? 1 }}" required>
                    <label for="berat_donasi_barang">Berat Barang (kg)</label>  
                    @error('berat_donasi_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <textarea id="inputKeteranganBarang" class="form-control"  name="keterangan_donasi_barang" placeholder="Keterangan Barang" style="height: 125px;" required>{{ old('keterangan_donasi_barang') }}</textarea>
                    <label for="inputKeteranganBarang">Keterangan Barang</label>
                    <p>Contoh: Baju anak perempuan ukuran L</p>
                </div>

                <button class="w-100 btn btn-lg btn-primary btn-block" type="submit">Kirim Barang</button>
            </form>
        </div>
    </div>
    </div>


    <div class="modal fade modal_donasi_uang" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <p>Silahkan isi Form Berikut</p>
            <form action="/donasi-uang" name="donasiUangForm" class="donasiUangForm" id="donasiUangForm" method="POST">
                @csrf
                <div class="form-floating">
                    <input id="inputNama" type="text" class="form-control @error('nama_donasi_uang') is-invalid @enderror" name="nama_donasi_uang" placeholder="nama" value="{{ old('nama_donasi_uang') }}" required autofocus>
                    <label for="inputNama">Nama</label>  
                    @error('nama_donasi_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <input type="hidden" name="tujuan_panti_donasi_uang" id="tujuan_panti" value="{{ $panti->nama_panti }}">

                <div class="form-floating">
                    <input id="inputEmail" type="email" class="form-control @error('email_donasi_uang') is-invalid @enderror" name="email_donasi_uang" placeholder="email" value="{{ old('email_donasi_uang') }}" required>
                    <label for="inputEmail">Email</label>  
                    @error('email_donasi_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input id="inputNomorWhatsapp"  type="tel" pattern="[0-9]+" class="form-control @error('nomor_donasi_uang') is-invalid @enderror" name="nomor_donasi_uang" placeholder="nomor" value="{{ old('nomor_donasi_uang') }}" required>
                    <label for="inputNomorWhatsapp">Nomor Whatsapp</label>  
                    @error('nomor_donasi_uang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <span>Nominal (Minimal Rp 30.000)</span><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-light" onclick="ubahNominal('50.000')">50k</label>
                    <label class="btn btn-light" onclick="ubahNominal('100.000')">100k</label>
                    <label class="btn btn-light" onclick="ubahNominal('300.000')">300k</label>
                    <label class="btn btn-light" onclick="ubahNominal('500.000')">500k</label>
                    <label class="btn btn-light" onclick="ubahNominal('1.000.000')">1000k</label>
                </div>

                <input id="inputNominal" type="text" class="form-control" name="jumlah_uang" required>

                <button class="w-100 btn btn-lg btn-primary btn-block" type="submit">Lanjutkan Pembayaran</button>
        </div>
    </div>
    </div>
    <script src="/js/donasiUang.js"></script>
@endsection