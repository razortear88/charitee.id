<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Panti extends Model
{
    use HasFactory,Sluggable;
    protected $guarded = ['id'];

    protected $casts = ['daftarKategoriKebutuhan'=>'array', 'daftarFoto'=>'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_panti'
            ]
        ];
    }

    public function donasi_uang(){
        return $this->hasMany(DonasiUang::class);
    }

    public function donasi_baran(){
        return $this->hasMany(DonasiBarang::class);
    }

}
