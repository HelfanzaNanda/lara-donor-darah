<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockDarah extends Model
{
    protected $table = "stok_darah";
    protected $fillable = [
        'gol_dar', 'jenis_tranfusi', 'rhesus', 'qty', 'harga'
    ];
}
