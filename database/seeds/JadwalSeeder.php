<?php

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Jadwal::class, 100)->create();
    }
}
