<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendonor extends Model
{
    protected $table = "pendonor";
    protected $fillable = [
        'user_id','ktp','nama','kabupaten','kecamatan','desa','alamat','jenis_kelamin','tempat_lahir','tanggal_lahir','pekerjaan','nama_ibu','status_nikah','phone','gol_dar','rhesus',
    ];
}
