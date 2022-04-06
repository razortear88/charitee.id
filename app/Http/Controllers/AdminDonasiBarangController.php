<?php

namespace App\Http\Controllers;
use App\Models\DonasiBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\DonasiBarangLunasMail;
use App\Mail\DonasiBarangAdminLunasMail;
use Illuminate\Support\Facades\Mail;

class AdminDonasiBarangController extends Controller
{
    public function index(){
        return view('admin.donasi_barang.index',[
            'all_donasi'=> DB::table('donasi_barangs')->where('status_donasi',false)->get()
        ]);
    }

    public function destroy(DonasiBarang $donasiBarang){
        DB::table('donasi_barangs')->where('id_donasi','=',$donasiBarang->id_donasi)->delete();
        return redirect('/admin/list-donasi-barang');
    }

    public function show(DonasiBarang $donasiBarang){

        return view('admin.donasi_barang.show',[
            'donasi'=> $donasiBarang
        ]);
    }

    public function setStatus(DonasiBarang $donasiBarang){
        DB::table('donasi_barangs')->where('id_donasi',$donasiBarang->id_donasi)->update(['status_donasi'=> true]);
        DB::table('pantis')
            ->where('nama_panti', $donasiBarang->nama_panti)
            ->update(['total_donatur' => DB::raw('total_donatur + 1'),
                    'total_donasi_barang' => DB::raw('total_donasi_barang + 1')]);

        $detail_donasi_barang=[
            'id_donasi'=>$donasiBarang->id_donasi,
            'nama_panti'=> $donasiBarang->nama_panti,
            'email_donatur'=> $donasiBarang->email_donatur,
            'jumlah_uang'=> $donasiBarang->jumlah_uang,
        ];
            
        Mail::to($donasiBarang->email_donatur)->queue(new DonasiBarangLunasMail($detail_donasi_barang));
        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new DonasiBarangAdminLunasMail($detail_donasi_barang));
        return redirect('/admin/list-donasi-barang');
    }
}
