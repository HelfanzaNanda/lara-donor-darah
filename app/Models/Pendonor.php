<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendonor extends Model
{
    protected $table = "pendonor";
    protected $fillable = [
        'user_id','ktp','nama','kabupaten','kecamatan','desa','alamat','jenis_kelamin','tempat_lahir','tanggal_lahir','pekerjaan','nama_ibu','status_nikah','phone','gol_dar','rhesus',
    ];

    
    public function cek_kabupaten()
    {
        return $this->belongsTo('App\Models\Kabupaten','kabupaten', 'id');
    }

    public function cek_kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan','kecamatan', 'id');
    }

    public function cek_desa()
    {
        return $this->belongsTo('App\Models\Desa', 'desa', 'id');
    }
}
