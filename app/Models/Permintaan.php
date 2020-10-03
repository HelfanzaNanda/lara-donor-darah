<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    protected $fillable = [
        'user_id',
        'darah_id',
        'nama_pasien',
        'jenis_kelamin',
        'ruangan',
        'diagnosa',
        'jumlah',
        'harga',
        'tempat',
        'tanggal',
        'nama_dokter',
        'status_permintaan',
        'status_pembayaran',
        'status_pengiriman',
    ];

    public function darah()
    {
        return $this->belongsTo('App\Models\StockDarah','darah_id','id');
    }

    public function pembayaran()
    {
        return $this->belongsTo('App\Models\Pembayaran','permintaan_id','id');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }
}
