<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $fillable = [
        'user_id',
        'nama_tempat',
        'hari',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'alamat',
        'foto',
        'penanggung_jawab',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    
}
