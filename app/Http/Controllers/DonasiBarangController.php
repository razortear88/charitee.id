<?php

namespace App\Http\Controllers;

use App\Models\DonasiBarang;
use App\Http\Requests\StoreDonasiBarangRequest;
use App\Http\Requests\UpdateDonasiBarangRequest;
use Illuminate\Support\Str;
use App\Mail\DonasiBarangMail;
use App\Mail\DonasiBarangAdminMail;
use Illuminate\Support\Facades\Mail;

class DonasiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DonasiBarang $donasi_barang)
    {
        return view('detail_donasi_barang',[
        'donasi'=> $donasi_barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonasiBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonasiBarangRequest $request)
    {        
        $checkData = $request->validate([
            'tujuan_panti_donasi_barang' => ['required'],
            'nama_donasi_barang' => ['required'],
            'email_donasi_barang' => ['required'],
            'berat_donasi_barang' => ['required'],
            'nomor_donasi_barang' => ['required'],
            'keterangan_donasi_barang' => ['required'],
            'lokasi_donasi_barang' => ['required'],
        ]);

        $validatedData['id_donasi'] = Str::random(24);
        $validatedData['nama_panti'] = $checkData['tujuan_panti_donasi_barang'];
        $validatedData['nama_donatur'] = $checkData['nama_donasi_barang'];
        $validatedData['email_donatur'] = $checkData['email_donasi_barang'];
        $validatedData['berat_barang'] = $checkData['berat_donasi_barang'];
        $validatedData['alamat_barang'] = $checkData['lokasi_donasi_barang'];
        $validatedData['nomor_kontak_donatur'] = $checkData['nomor_donasi_barang'];
        $validatedData['keterangan_barang'] = $request['keterangan_donasi_barang'];
        $validatedData['status_donasi'] = false;
        
        DonasiBarang::create($validatedData);

        $detail_donasi_barang=[
            'id_donasi'=>$validatedData['id_donasi'],
            'nama_panti'=> $validatedData['nama_panti'],
            'nama_donatur'=> $validatedData['nama_donatur'],
            'email_donatur'=> $validatedData['email_donatur'],
            'berat_barang'=> $validatedData['berat_barang'],
            'alamat_barang'=> $validatedData['alamat_barang'],
            'nomor_kontak_donatur'=> $validatedData['nomor_kontak_donatur'],
            'keterangan_barang'=> $validatedData['keterangan_barang'],
            'url' =>  env("APP_URL").'/donasi-barang/'.$validatedData['id_donasi'],
            'url_admin' => env("APP_URL").'/admin/donasi-barang/'.$validatedData['id_donasi'],
            
        ];
        Mail::to($detail_donasi_barang['email_donatur'])->queue(new DonasiBarangMail($detail_donasi_barang));
        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new DonasiBarangAdminMail($detail_donasi_barang));

        return redirect('/donasi-barang/'.$validatedData['id_donasi']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonasiBarang  $donasiBarang
     * @return \Illuminate\Http\Response
     */
    public function show(DonasiBarang $donasiBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonasiBarang  $donasiBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(DonasiBarang $donasiBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonasiBarangRequest  $request
     * @param  \App\Models\DonasiBarang  $donasiBarang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonasiBarangRequest $request, DonasiBarang $donasiBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonasiBarang  $donasiBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonasiBarang $donasiBarang)
    {
        //
    }
}
