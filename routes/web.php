<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PantiController;
use App\Http\Controllers\DonasiUangController;
use App\Http\Controllers\DonasiBarangController;
use App\Http\Controllers\AdminDonasiUangController;
use App\Http\Controllers\AdminDonasiBarangController;
use App\Http\Controllers\AdminPantiController;
use App\Http\Controllers\AdminKategoriKebutuhanController;

Route::get('/',[LoginController::class,'home']);

Route::get('/login',[LoginController::class,'index']);

Route::post('/login',[LoginController::class,'authenticate']);

Route::get('/panti/{panti:slug}', [PantiController::class,'show']);

Route::get('/list-panti', [PantiController::class,'index']);

Route::post('/donasi-uang',[DonasiUangController::class,'store']);

Route::post('/donasi-barang',[DonasiBarangController::class,'store']);

Route::get('/donasi-uang/{donasi_uang:id_donasi}',[DonasiUangController::class,'index']);

Route::get('/donasi-barang/{donasi_barang:id_donasi}',[DonasiBarangController::class,'index']);

#Admin

Route::get('/admin/list-donasi-uang',[AdminDonasiUangController::class,'index']);

Route::get('/admin/donasi-uang/{donasi_uang:id_donasi}',[AdminDonasiUangController::class,'show']);

Route::post('/admin/donasi-uang/set-status/{donasi_uang:id_donasi}',[AdminDonasiUangController::class,'setStatus']);

Route::delete('/admin/donasi-uang/{donasi_uang:id_donasi}',[AdminDonasiUangController::class,'destroy']);

Route::get('/admin/list-donasi-barang',[AdminDonasiBarangController::class,'index']);

Route::get('/admin/donasi-barang/{donasi_barang:id_donasi}',[AdminDonasiBarangController::class,'show']);

Route::post('/admin/donasi-barang/set-status/{donasi_barang:id_donasi}',[AdminDonasiBarangController::class,'setStatus']);

Route::delete('/admin/donasi-barang/{donasi_barang:id_donasi}',[AdminDonasiBarangController::class,'destroy']);

Route::get('/admin/list-panti',[AdminPantiController::class,'index']);

Route::get('/admin/panti/create',[AdminPantiController::class,'create']);

Route::post('/admin/panti',[AdminPantiController::class,'store']);

Route::get('/admin/panti/{panti:slug}/edit',[AdminPantiController::class,'edit']);

Route::post('/admin/panti/{panti:slug}/update',[AdminPantiController::class,'update']);

Route::delete('/admin/panti/{panti:slug}',[AdminPantiController::class,'destroy']);

Route::get('/admin/panti/checkSlug',[AdminPantiController::class,'checkSlug']);

Route::get('/admin/kategori/create',[AdminKategoriKebutuhanController::class,'create']);

Route::get('/admin/list-kategori',[AdminKategoriKebutuhanController::class,'index']);

Route::post('/admin/kategori',[AdminKategoriKebutuhanController::class,'store']);

Route::get('/admin/kategori/{kategori_kebutuhan:nama}/edit',[AdminKategoriKebutuhanController::class,'edit']);

Route::post('/admin/kategori/{kategori_kebutuhan:nama}',[AdminKategoriKebutuhanController::class,'update']);

Route::delete('/admin/kategori/{kategori_kebutuhan:nama}',[AdminKategoriKebutuhanController::class,'destroy']);

Route::get('/admin/kategori/checkSlug',[AdminKategoriKebutuhanController::class,'checkSlug']);

Route::get('/navbar',function(){
    return view('layouts.header');
});