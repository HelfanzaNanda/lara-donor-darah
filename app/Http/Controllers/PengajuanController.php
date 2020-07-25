<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Jadwal;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifPengajuan;

class PengajuanController extends Controller
{
    
    public function index()
    {
        $data['pengajuan'] = Pengajuan::all();
        return view('dashboard.pengajuan.all',$data);
    }

    public function edit($id)
    {
        $data['pengajuan'] = Pengajuan::find($id);
        return view('dashboard.pengajuan.edit',$data);
    }

    public function update(Request $request, $id)
    {
        // $status = $request->status;
        $pengajuan = Pengajuan::find($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();
        if($pengajuan->status == 'diterima'){
            $data_jadwal = new Jadwal([
                'nama_tempat' => $pengajuan->nama_tempat,
                'hari' => $pengajuan->hari,
                'tanggal' => $pengajuan->tanggal,
                'jam_mulai' => $pengajuan->jam_mulai,
                'jam_selesai' => $pengajuan->jam_selesai,
                'alamat' => $pengajuan->alamat
            ]);
            
            $data_jadwal->save();
        }
        
        $user = User::find($pengajuan->user_id);
        Mail::to($user->email)->send(new NotifPengajuan($user, $pengajuan));

        return redirect()->route('pengajuan.index');
    }
}
