<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kelompok;
use App\Models\Poktan;
use App\Models\User;
use App\Models\Berita;
use App\Models\Penyuluh;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@hotmail.com',
            'telp' => '081208120812',
            // 'roles' => 'admin',
            'status' => 'Aktif',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Penyuluh',
            'username' => 'penyuluh',
            'email' => 'penyuluh@hotmail.com',
            'telp' => '081208120812',
            // 'roles' => 'penyuluh',
            'status' => 'Aktif',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Petani',
            'username' => 'petani',
            'email' => 'petani@hotmail.com',
            'telp' => '081208120812',
            // 'roles' => 'petani',
            'status' => 'Aktif',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Kabid',
            'username' => 'kabid',
            'email' => 'kabid@hotmail.com',
            'telp' => '081208120812',
            // 'roles' => 'kabid',
            'status' => 'Aktif',
            'password' => bcrypt('secret'),
        ]);

        // User::create([
        //     'name' => 'Petani',
        //     'username' => 'petani',
        //     'email' => 'petani@hotmail.com',
        //     'telp' => '081208120812',
        //     // 'roles' => 'petani',
        //     'status' => 'Aktif',
        //     'password' => bcrypt('secret'),
        // ]);


        $kecamatan = ["Banjarmasin Tengah", "Banjarmasin Utara", "Banjarmasin Selatan", "Banjarmasin Barat", "Banjarmasin Timur"];

        foreach ($kecamatan as $kec) {
            \App\Models\Kecamatan::create([
                'nama' => $kec,
            ]);
        }

        $this->call([
            UserPermissionSeeder::class,
        ]);

        Kelurahan::create([
            'kecamatan_id' => '1',
            'nama' => 'Sungai Jingah',
        ]);

        Penyuluh::create([
            'nama_penyuluh' => 'Budi',
            'nip_penyuluh' => '1234567890',
            'no_hp_penyuluh' => '081208120812',
            'alamat_penyuluh' => 'sungai jingah',
        ]);
        Penyuluh::create([
            'nama_penyuluh' => 'Penyuluh',
            'nip_penyuluh' => '1234567890',
            'no_hp_penyuluh' => '081208120812',
            'alamat_penyuluh' => 'sungai jingah',
        ]);

        Kelompok::create([
           'nama_kelompok'=>'Sejahtera team', 
        ]);

        Poktan::create([
            'nama_petani' => 'Sejahtera',
            'luas_lahan_poktan' => '5 hektar',
            'no_hp_poktan' => '081208120812',
            'status_poktan' => 'aktif',
            'alamat_poktan' => 'sungai jingah',
            'penyuluh_id' => '1',
            // 'kelompok_id' => '1',
            'kecamatan_id' => '1',
            'kelurahan_id' => '1',
        ]);

        Berita::create([
            'judul_berita' => 'Berita Pertama',
            'isi_berita' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.',
            'slug' => 'berita-pertama',
        ]);

        // $kelurahan = ["Antasan Besar", "Antasan Kecil Timur", "Antasan Kecil Barat", "Antasan Kecil", "Bakung", "Bakung Barat", "Bakung Utara", "Bakung Timur", "Bakung Selatan", "Bakung Permai", "Bakung Rejo", "Bakung Raya", "Bakung Serumpun", "Bakung Sari", "Bakung Sari Barat", "Bakung Sari Timur", "Bakung Utama", "Bakung Utama Barat", "Bakung Utama Timur", "Bakung Utama Selatan", "Bakung Utama Raya", "Bakung Utama Permai", "Bakung Utama Rejo", "Bakung Utama Serumpun", "Bakung Utama Sari", "Bakung Utama Sari Barat", "Bakung Utama Sari Timur", "Bakung Utama Sari Selatan", "Bakung Utama Sari Raya", "Bakung Utama Sari Permai", "Bakung Utama Sari Rejo", "Bakung Utama Sari Serumpun", "Bakung Utama Sari Utama", "Bakung Utama Sari Utama Barat", "Bakung Utama Sari Utama Timur", "Bakung Utama Sari Utama Selatan", "Bakung Utama Sari Utama Raya", "Bakung Utama Sari Utama Permai", "Bakung Utama Sari Utama Rejo", "Bakung Utama Sari Utama Serumpun"];

        // membuat data table hasil_panen dummy
        // for ($i = 0; $i < 100; $i++) {
        //     \App\Models\HasilPanen::create([
        //         'kecamatan_id' => 1,
        //         'kelurahan_id' => 1,
        //         'kelompok_tani' => 'Kelompok Tani ' . $i,
        //         'luas_lahan' => rand(1, 10),
        //         'hasil_produksi' => rand(1, 100),
        //         'detail_hasil_produksi' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores, explicabo sit incidunt officiis voluptates suscipit. Soluta placeat numquam neque explicabo.",
        //         'url_lokasi' => "https://maps.app.goo.gl/35KdyjRVCBZgpFMU8",
        //         'alamat_ubinan' => 'Alamat ' . $i,
        //         'gkp' => rand(1, 100),
        //         'gkg' => rand(1, 100),
        //     ]);
        // }
    }
}
