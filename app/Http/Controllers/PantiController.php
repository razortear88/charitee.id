<?php

namespace App\Http\Controllers;

use App\Models\Panti;
use App\Http\Requests\UpdatePantiRequest;
use App\Models\DonasiUang;
use App\Models\Kategori_Kebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PantiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panti.list_panti',[
            'list_kategori' => Kategori_Kebutuhan::all(),
            'list_panti' => Panti::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePantiRequest  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Panti  $panti
     * @return \Illuminate\Http\Response
     */
    public function show(Panti $panti){
        
        $list_donasi_uang_panti_lunas = DB::table('donasi_uangs')->where(['nama_panti'=>$panti->nama_panti, 'status_donasi'=>true])->get();
        $total_pendapatan_terakhir = 0;
        foreach($list_donasi_uang_panti_lunas as $donasi){
            
            if(abs(strtotime(date('Y-m-d')) - strtotime($donasi->tanggal_lunas))/60/60/24/30 <=3){
                $total_pendapatan_terakhir += $donasi->jumlah_uang;
            }
        }
        return view('panti.detail_panti',[
            "panti" => $panti,
            "total_pendapatan_terakhir" => $total_pendapatan_terakhir
        ]);
        
    }
}
