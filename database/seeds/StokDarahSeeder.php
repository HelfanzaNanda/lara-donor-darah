<?php

use App\Models\StockDarah;
use Illuminate\Database\Seeder;

class StokDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StockDarah::create([
            'gol_dar' => 'B',
            'rhesus' => '-',
            'jenis_tranfusi' => 'Fresh Frozen Plasma',
            'harga' => 300000,
            'qty' => 3
        ]);

        StockDarah::create([
            'gol_dar' => 'AB',
            'rhesus' => '+',
            'jenis_tranfusi' => 'Leucodepleted',
            'harga' => 300000,
            'qty' => 2
        ]);

        StockDarah::create([
            'gol_dar' => 'O',
            'rhesus' => '+',
            'jenis_tranfusi' => 'Leucodepleted',
            'harga' => 300000,
            'qty' => 3
        ]);

        StockDarah::create([
            'gol_dar' => 'O',
            'rhesus' => '-',
            'jenis_tranfusi' => 'Whole Blood',
            'harga' => 350000,
            'qty' => 12
        ]);
        StockDarah::create([
            'gol_dar' => 'A',
            'rhesus' => '-',
            'jenis_tranfusi' => 'Trombocyte Concentrate',
            'harga' => 450000,
            'qty' => 5
        ]);
        StockDarah::create([
            'gol_dar' => 'B',
            'rhesus' => '+',
            'jenis_tranfusi' => 'Packed Red Cell',
            'harga' => 400000,
            'qty' => 7
        ]);

    }
}
