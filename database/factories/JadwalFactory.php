<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Jadwal;
use App\User;
use Faker\Generator as Faker;

$factory->define(Jadwal::class, function (Faker $faker) {
    $rs = User::where('role', 'rs')->pluck('id')->toArray();
    $tempat = ['SMA N 1 Tegal', 'SMA N 2 Tegal', 'SMA N 3 Tegal', 'SMK N 3 Tegal', 
    'SMK Muhammadiyah 1 Tegal', 'SUPM N Tegal', 'SMK Bahari Tegal', 'SMK N 1 Tegal',
    'SMK N 2 Tegal', 'SMA PIUS Tegal'];
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    return [
        'user_id' => $faker->randomElement($rs),
        'nama_tempat' => $faker->randomElement($tempat),
        'hari' => $faker->randomElement($days),
        'tanggal' => $faker->dateTimeBetween('-8 month', '+8 month'),
        'alamat' => $faker->address,
        'status' => 'selesai',
        'jam_mulai' => $faker->time('h:i', 'now'),
        'jam_selesai' => $faker->time('h:i', 'now'),
        'created_at' => $faker->dateTimeBetween('-8 month', '+8 month'),
    ];
});
