<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'kristina',
            'email' => 'kristina@gmail.com',
            'password'=> Hash::make('kristina'),
            'role' => 'pmi',
            'phone' => '082313525250',
        ]);

        // User::create([
        //     'nama' => 'rsi',
        //     'email' => 'rsi@gmail.com',
        //     'password'=> Hash::make('12345678'),
        //     'role' => 'rs',
        //     'nama_rs' => 'RSI',
        //     'phone' => '082313525252',
        // ]);

        // User::create([
        //     'nama' => 'kardinah',
        //     'email' => 'kardinah@gmail.com',
        //     'password'=> Hash::make('12345678'),
        //     'role' => 'rs',
        //     'nama_rs' => 'Kardinah',
        //     'phone' => '082313515252',
        // ]);

        User::create([
            'nama' => 'pendonor',
            'email' => 'pendonor@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 'pendonor',
            'phone' => '082303525252',
        ]);

        factory(User::class, 6)->create();
    }
}
