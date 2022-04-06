<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Kebutuhan;
use App\Models\Panti;
use App\Http\Requests\StoreKategori_KebutuhanRequest;
use App\Http\Requests\UpdateKategori_KebutuhanRequest;
use Illuminate\Support\facades\Storage;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminKategoriKebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.kategori_kebutuhan.index",[
            'list_kategori' => Kategori_Kebutuhan::all()->sortBy('nama')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori_kebutuhan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKategori_KebutuhanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategori_KebutuhanRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'max:255','unique:kategori__kebutuhans'],
            'slug' => ['required', 'max:255','unique:kategori__kebutuhans'],
            'ikon' => ['required','image','file','max:5120']
        ]);

        if($request->file('ikon')){
            $validatedData['ikon'] = $request->file('ikon')->storeAs('kategori_kebutuhan-ikons',$validatedData['slug'].".png");
        }

        Kategori_Kebutuhan::create($validatedData);

        return redirect('/admin/list-kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori_Kebutuhan  $kategori_Kebutuhan
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori_Kebutuhan $kategori_Kebutuhan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori_Kebutuhan  $kategori_Kebutuhan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori_Kebutuhan $kategori_kebutuhan)
    {
        return view('admin.kategori_kebutuhan.update',[
            'kategori' => $kategori_kebutuhan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKategori_KebutuhanRequest  $request
     * @param  \App\Models\Kategori_Kebutuhan  $kategori_Kebutuhan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategori_KebutuhanRequest $request, Kategori_Kebutuhan $kategori_kebutuhan)
    {
        $validatedData = [];
        if($kategori_kebutuhan->nama != $request['nama']){
            $validatedData= $request->validate([
                'nama' => ['required', 'max:255' ,'unique:kategori__kebutuhans'],
                'slug' => ['required', 'max:255' ,'unique:kategori__kebutuhans']
            ]);
            Storage::move($kategori_kebutuhan->ikon, 'kategori_kebutuhan-ikons/'.$validatedData['slug'].".png" );
            $validatedData['ikon'] = 'kategori_kebutuhan-ikons/'.$validatedData['slug'].".png";
        }

        if($request->hasFile('ikon')){
                Storage::delete($kategori_kebutuhan->ikon);
                $validatedData['ikon'] = $request->file('ikon')->storeAs('kategori_kebutuhan-ikons',$request['slug'].".png");
        }

        Kategori_Kebutuhan::where('nama',$kategori_kebutuhan->nama)->update($validatedData);
        
        if($kategori_kebutuhan->nama != $request['nama']){
            $all_panti = Panti::all();
    
            foreach($all_panti as $panti){
                if(in_array($kategori_kebutuhan->slug,json_decode($panti->daftar_kategori_kebutuhan))){
                    $new_kategori = json_decode($panti->daftar_kategori_kebutuhan);
                    $index = array_search($kategori_kebutuhan->slug,$new_kategori);
                    unset($new_kategori[$index]);
                    $validatedDataKategori['daftar_kategori_kebutuhan'] = array();
                    foreach($new_kategori as $kategori){
                        $validatedDataKategori['daftar_kategori_kebutuhan'][] = $kategori;
                    }
                    sort($validatedDataKategori['daftar_kategori_kebutuhan']);
                    $validatedDataKategori['daftar_kategori_kebutuhan'][] = $validatedData['slug'];
                    Panti::where('slug',$panti->slug)->update($validatedDataKategori);
                }
            }
        }
        return redirect('/admin/list-kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori_Kebutuhan  $kategori_Kebutuhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori_Kebutuhan $kategori_kebutuhan)
    {
        $slug_kategori = $kategori_kebutuhan->slug;

        if($kategori_kebutuhan->ikon){
            Storage::delete($kategori_kebutuhan->ikon);
        }
        
        Kategori_Kebutuhan::destroy($kategori_kebutuhan->id);

        $all_panti = Panti::all();

        foreach($all_panti as $panti){
            if(in_array($slug_kategori,json_decode($panti->daftar_kategori_kebutuhan))){
                $new_kategori = json_decode($panti->daftar_kategori_kebutuhan);
                $index = array_search($slug_kategori,$new_kategori);
                unset($new_kategori[$index]);
                $validatedData['daftar_kategori_kebutuhan'] = array();
                foreach($new_kategori as $kategori){
                    $validatedData['daftar_kategori_kebutuhan'][] = $kategori;
                }
                sort( $validatedData['daftar_kategori_kebutuhan']);
                Panti::where('slug',$panti->slug)->update($validatedData);
            }
        }
        return redirect('/admin/list-kategori');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Kategori_Kebutuhan::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
