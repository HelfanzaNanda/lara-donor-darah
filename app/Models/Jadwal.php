<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat','foto'
    ];
}
