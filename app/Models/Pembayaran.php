<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = "pembayaran";
    protected $fillable = [
        'permintaan_id', 'user_id', 'bukti_pembayaran', 'tipe_pembayaran', 'tanggal_pembayaran', 'total_pembayaran'
    ];
    

    public function getPermintaan()
    {
        return $this->belongsTo('App\Models\Permintaan','permintaan_id','id');
    }
}
