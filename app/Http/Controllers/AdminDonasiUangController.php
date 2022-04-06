<?php

namespace App\Http\Controllers;
use App\Models\DonasiUang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonasiUangAdminLunasMail;
use App\Mail\DonasiUangLunasMail;

class AdminDonasiUangController extends Controller
{
    public function index(){
        return view('admin.donasi_uang.index',[
            'all_donasi'=> DB::table('donasi_uangs')->where('status_donasi',false)->get()
        ]);
    }

    public function destroy(DonasiUang $donasiUang){
        DB::table('donasi_uangs')->where('id_donasi','=',$donasiUang->id_donasi)->delete();
        return redirect('/admin/list-donasi-uang');
        
    }

    public function show(DonasiUang $donasiUang){
        return view('admin.donasi_uang.show',[
            'donasi'=> $donasiUang
        ]);
    }

    public function setStatus(DonasiUang $donasiUang){
        DB::table('donasi_uangs')->where('id_donasi',$donasiUang->id_donasi)->update(['status_donasi'=> true,'tanggal_lunas'=> date("Y-m-d")]);
        DB::table('pantis')
            ->where('nama_panti', $donasiUang->nama_panti)
            ->update(['total_donatur' => DB::raw('total_donatur + 1'),]);
        $detail_donasi_uang=[
            'id_donasi'=>$donasiUang->id_donasi,
            'nama_panti'=> $donasiUang->nama_panti,
            'email_donatur'=> $donasiUang->email_donatur,
            'jumlah_uang'=> $donasiUang->jumlah_uang,
        ];
            
        Mail::to($donasiUang->email_donatur)->queue(new DonasiUangLunasMail($detail_donasi_uang));
        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new DonasiUangAdminLunasMail($detail_donasi_uang));
    
        return redirect('/admin/list-donasi-uang');
    }
}
