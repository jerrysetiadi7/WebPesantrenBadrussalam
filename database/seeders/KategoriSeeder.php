<?php

namespace Database\Seeders;

use App\Models\kategoriModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Optional, untuk waktu
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        kategoriModel::insert([
            [
                'nama_kategori' => 'Ceramah',
                'tipe_kategori' => 'dakwah',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Kultum',
                'tipe_kategori' => 'dakwah',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Dokumentasi',
                'tipe_kategori' => 'galeri',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Event',
                'tipe_kategori' => 'galeri',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
