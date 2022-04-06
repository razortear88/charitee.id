<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Panti;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'email' => 'nicholaspangestu@yahoo.co.id',
            'nama' => 'Nicholas Pangestu',
            'nomor_kontak' => '735986',
            'password' => bcrypt('papa123')
        ]);

        // Panti::create([
        //     'nama_panti' => 'panti1',
        //     'lokasi' => 'lokasi1',
        //     'informasi' => 'Lorem ipsum',
        //     'kebutuhan' => 'kebutuhan1',
        //     'jumlah_anak' => 21,
        //     'nomor_kontak' => '026735986',
        //     'total_donatur' => 10,
        //     'total_donasi_barang' => 15,
        //     'daftar_kategori_kebutuhan' => "['nimo','idu','enes','gepeng', 'halilintar']",
        //     'daftar_foto' => "['pic1','pic2','pic3']"

        // ]);
        // // \App\Models\User::factory(10)->create();
    }
}
