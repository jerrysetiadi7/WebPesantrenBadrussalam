<?php

namespace Database\Seeders;
use App\Models\kategoriModel;
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
        $this->call([
            KategoriSeeder::class,
        ]);// \App\Models\User::factory(10)->create();
    }
}
