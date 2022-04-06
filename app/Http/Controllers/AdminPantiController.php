<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panti;
use App\Models\Kategori_Kebutuhan;
use Illuminate\Support\facades\Storage;
use App\Http\Requests\StorePantiRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminPantiController extends Controller
{
    //
    public function index(){
        return view('admin.panti.index',[
            'all_panti'=> Panti::all()
        ]);
    }

    public function create(){
        return view('admin.panti.create',[
            'list_kategori' => Kategori_Kebutuhan::all()
        ]);
    }

    public function store(StorePantiRequest $request)
    {   
        $validatedData = $request->validate([
            'nama_panti' => ['required', 'max:255','unique:pantis'],
            'lokasi' => ['required'],
            'kecamatan' => ['required'],
            'kota' => ['required'],
            'informasi' => ['required'],
            'kebutuhan' => ['required'],
            'jumlah_anak' => ['required'],
            'nomor_kontak' => ['required'],
        ]);
        $validatedData['kecamatan'] = ucwords($request['kecamatan']) ;
        $validatedData['kota'] = ucwords($request['kota']) ;

        $all_kategori = Kategori_Kebutuhan::all();
        $list_kategori = array();
        #kategori panti
        foreach($all_kategori as $kategori){
            if($request['kategori-'.$kategori->slug] == 'on'){
                $list_kategori[] = $kategori->slug;
            }
        }
        sort($list_kategori);
        
        
        #foto panti
        $files = $request->file('gambar');
        if($request->hasFile('gambar')){
            $list_gambar = array();
            foreach($files as $file) {
                $file->store('panti-gambars');
                $list_gambar[] = $file->hashName();
            }
        }
        $validatedData['daftar_kategori_kebutuhan'] = json_encode($list_kategori);
        $validatedData['daftar_foto'] = json_encode($list_gambar);
        $validatedData['total_donatur'] = 0;
        $validatedData['total_donasi_barang'] = 0;

        Panti::create($validatedData);
        return redirect('/admin/list-panti');
    }

    public function edit(Panti $panti){   
        return view('admin.panti.update',[
            'panti' => $panti,
            'list_kategori' => Kategori_Kebutuhan::all(),
            'old_kategori' => json_decode($panti->daftar_kategori_kebutuhan),
            'old_foto' => json_decode($panti->daftar_foto)
        ]);
    }

    public function update(Request $request, Panti $panti){
        $rules = [
            'nama_panti' => ['required', 'max:255'],
            'lokasi' => ['required'],
            'kebutuhan' => ['required'],
            'jumlah_anak' => ['required'],
            'nomor_kontak' => ['required'],
            'lokasi' => ['required'],
            'kecamatan' => ['required'],
            'kota' => ['required'],
            'informasi' => ['required']
        ];
        
        if($request->slug != $panti->slug){
             $rules['slug'] = ['unique:pantis'];
        }

        $all_kategori = Kategori_Kebutuhan::all();
        $list_kategori = array();
        #kategori panti
        foreach($all_kategori as $kategori){
            if($request['kategori-'.$kategori->slug] == 'on'){
                $list_kategori[] = $kategori->slug;
            }
        }
        sort($list_kategori);

        #gambar
        $old_foto = json_decode($panti->daftar_foto);
        $list_gambar_baru = array();
        $index = 0; 
        foreach($old_foto as $foto){
            if($request['gambar-'.$index] != 'on'){
                Storage::delete('panti-gambars/'.$foto);
            }
            else{
                $list_gambar_baru[] = $foto;
            }
            $index+=1;
        }

        $files = $request->file('gambar');
        if($request->hasFile('gambar')){
            foreach($files as $file) {
                $file->store('panti-gambars');
                $list_gambar_baru[] = $file->hashName();
            }
        }

        $validatedData = $request->validate($rules);
        $validatedData['daftar_kategori_kebutuhan'] = json_encode($list_kategori);
        $validatedData['daftar_foto'] = json_encode($list_gambar_baru);
        Panti::where('slug',$panti->slug)->update($validatedData);
        return redirect('/admin/list-panti');
    }

    public function destroy(Panti $panti)
    {
        if($panti->daftar_foto){
            $list_foto = json_decode($panti->daftar_foto);
            foreach($list_foto as $foto){
                Storage::delete('panti-gambars/'.$foto);
            }
        }
        Panti::where('slug',$panti->slug)->delete();
        return redirect('/admin/list-panti');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Panti::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
