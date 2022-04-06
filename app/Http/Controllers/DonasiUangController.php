<?php

namespace App\Http\Controllers;

use App\Models\DonasiUang;
use App\Http\Requests\StoreDonasiUangRequest;
use App\Http\Requests\UpdateDonasiUangRequest;
use App\Mail\DonasiUangMail;
use App\Mail\DonasiUangAdminMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class DonasiUangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DonasiUang $donasi_uang)
    {
        return view('detail_donasi_uang',[
        'donasi'=> $donasi_uang]);
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
     * @param  \App\Http\Requests\StoreDonasiUangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonasiUangRequest $request)
    { 

        $checkData = $request->validate([
            'tujuan_panti_donasi_uang' => ['required'],
            'nama_donasi_uang' => ['required'],
            'email_donasi_uang' => ['required'],
            'nomor_donasi_uang' => ['required'],
            'jumlah_uang' => ['required'],
        ]);

        $validatedData['id_donasi'] = Str::random(25);
        $validatedData['nama_panti'] = $checkData['tujuan_panti_donasi_uang'];
        $validatedData['nama_donatur'] = $checkData['nama_donasi_uang'];
        $validatedData['email_donatur'] = $checkData['email_donasi_uang'];
        $validatedData['nomor_kontak_donatur'] = $checkData['nomor_donasi_uang'];
        $validatedData['jumlah_uang'] = (float) str_replace('.','',$checkData['jumlah_uang']);
        $validatedData['status_donasi'] = false;

        DonasiUang::create($validatedData);
        $detail_donasi_uang=[
            'id_donasi'=>$validatedData['id_donasi'],
            'nama_panti'=> $validatedData['nama_panti'],
            'nama_donatur'=> $validatedData['nama_donatur'],
            'email_donatur'=> $validatedData['email_donatur'],
            'nomor_kontak_donatur'=> $validatedData['nomor_kontak_donatur'],
            'jumlah_uang'=> $checkData['jumlah_uang'],
            'url' =>  env("APP_URL").'/donasi-uang/'.$validatedData['id_donasi'],
            'url_admin' => env("APP_URL").'/admin/donasi-uang/'.$validatedData['id_donasi'],
        ];
        
        Mail::to($detail_donasi_uang['email_donatur'])->queue(new DonasiUangMail($detail_donasi_uang));
        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new DonasiUangAdminMail($detail_donasi_uang));

        return redirect('/donasi-uang/'.$validatedData['id_donasi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonasiUang  $donasiUang
     * @return \Illuminate\Http\Response
     */
    public function show(DonasiUang $donasiUang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DonasiUang  $donasiUang
     * @return \Illuminate\Http\Response
     */
    public function edit(DonasiUang $donasiUang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonasiUangRequest  $request
     * @param  \App\Models\DonasiUang  $donasiUang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonasiUangRequest $request, DonasiUang $donasiUang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonasiUang  $donasiUang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonasiUang $donasiUang)
    {
        //
    }
}
