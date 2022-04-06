<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DonasiBarang;
use App\Models\DonasiUang;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    
    public function home(){
        $jumlah_donasi_uang = DB::table('donasi_uangs')->where('status_donasi',true)->sum('jumlah_uang');
        $total_donatur = 0;
        $total_donatur += DB::table('donasi_uangs')->where('status_donasi',true)->count();
        $total_donatur += DB::table('donasi_barangs')->where('status_donasi',true)->count();
        return view('home',[
            'total_donatur' =>$total_donatur,
            'total_donasi_uang' => number_format($jumlah_donasi_uang,0,',','.'),
            'total_donasi_barang' => DB::table('donasi_barangs')->where('status_donasi',true)->count(),
        ]);
    }
    public function index(){
        return view("login.index",[
            "title" => "Login"
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
