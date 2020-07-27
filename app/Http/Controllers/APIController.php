<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Pengajuan;
use App\Models\StockDarah;
use App\Models\Pendonor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgotPassword;

class APIController extends Controller
{
    public function userRegister(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            // 'phone' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'phone'      => "08923423455",
            'role'       => 'pendonor',
            'password'   => bcrypt($request->password)
        ]);

        if($user){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function userLogin(Request $request)
    {
        $input = $request->all();

        $role = "pendonor";
        // $email = $input['email'];

        $cek = auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'role' => $role));

        if($cek){
            // $result = [];
            $login = User::where('email',$input['email'])->get();
            foreach ($login as $logg) {
                $result["login"] = [[
                    "id" => $logg->id,
                    "nama" => $logg->nama,
                    "email" => $logg->email,
                    "phone" => $logg->phone,
                    "role" => $logg->role,
                    "foto" => $logg->foto,
                ]];
                $result["success"] = "1";
                $result["message"] = "success";
                //untuk memanggil data sesi Login
                echo json_encode($result);
            }
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function detailUser(Request $request)
    {
        $id = $request->id;

        $cek = User::where('id',$id)->get();
        if($cek){
            foreach($cek as $u){
                $result["read"] = [[
                    "id" => $u->id,
                    "nama" => $u->nama,
                    "email" => $u->email,
                    "phone" => $u->phone,
                    "role" => "Pendonor",
                    "foto" => $u->foto,
                ]];
                $result["success"] = "1";
                $result["message"] = "success";
                //untuk memanggil data sesi Login
                echo json_encode($result);
            }
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function updateUser(Request $request)
    {
        $getId = $request->id;
        $user = User::find($getId);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->foto = $request->foto;
        $user->role = "Pendonor";
        $user->save();

        if($user){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function upload(Request $request)
    {
        $getId = $request->id;
        $cover = $request->file('foto');
        $extension = $cover->getClientOriginalExtension();

        Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

        $user = User::find($getId);
        $user->foto = $cover->getFileName().'.'.$extension;
        $user->save();

        if($user){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $id = $request->id;
        $user = User::where('email',$email)->first();

        $send = Mail::to($user->email)->send(new SendForgotPassword($user));
        $result["success"] = "1";
        $result["message"] = "success";
        echo json_encode($result);
    }

    //Json data Informasi

    public function getInformation(Request $request)
    {
        $getInformation = Information::where('kategori','informasi')->get();
        if($getInformation){
            $result["read"] = [];
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "title" => $u->title,
                    "image" => url('/uploads/'.$u->image),
                    "kategori" => $u->kategori,
                    "content" => $u->content,
                ];
                array_push($result["read"],$data);
            }
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function getBerita(Request $request)
    {
        $getInformation = Information::where('kategori','berita')->get();
        if($getInformation){
            $result["read"] = [];
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "title" => $u->title,
                    "image" => url('/uploads/'.$u->image),
                    "kategori" => $u->kategori,
                    "content" => $u->content,
                ];
                array_push($result["read"],$data);
            }
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }


    public function getJadwal(Request $request)
    {
        $getInformation = Jadwal::orderBy('tanggal', 'ASC')->get();
        if($getInformation){
            $result["read"] = [];
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "nama_tempat" => $u->nama_tempat,
                    "foto" => url('/uploads/'.$u->foto),
                    "alamat" => $u->alamat,
                    "hari" => $u->hari,
                    "tanggal" => "(".$u->tanggal.")",
                    "jam_mulai" => $u->jam_mulai,
                    "jam_selesai" => $u->jam_selesai,
                ];
                array_push($result["read"],$data);
            }
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }


    public function getStockDarah(Request $request)
    {
        $getInformation = StockDarah::orderBy('gol_dar','ASC')->get();
        if($getInformation){
            $result["read"] = [];
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "gol_dar" => $u->gol_dar,
                    "rhesus" => $u->rhesus,
                    "jenis_tranfusi" => $u->jenis_tranfusi,
                    "qty" => $u->qty,
                ];
                array_push($result["read"],$data);
            }
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }


    public function getPendonor(Request $request)
    {
        $user_id = $request->user_id;
        $getPendonor = Pendonor::where('user_id', $request->user_id)->get();
        if($getPendonor){
            $result["read"] = [];
            foreach($getPendonor as $u){
                $data = [
                    'id' => $u->id,
                    'user_id' => $u->user_id,
                    'ktp' => $u->ktp,
                    'nama' => $u->nama,
                    'kabupaten' => $u->kabupaten,
                    'kecamatan' => $u->kecamatan,
                    'desa' => $u->desa,
                    'alamat' => $u->alamat,
                    'jenis_kelamin' => $u->jenis_kelamin,
                    'tempat_lahir' => $u->tempat_lahir,
                    'tanggal_lahir' => $u->tanggal_lahir,
                    'pekerjaan' => $u->pekerjaan,
                    'nama_ibu' => $u->nama_ibu,
                    'status_nikah' => $u->status_nikah,
                    'phone' => $u->phone,
                    'gol_dar' => $u->gol_dar,
                    'rhesus' => $u->rhesus,
                    'gol_rhesus' => $u->gol_dar.''.$u->rhesus,
                ];
                array_push($result["read"],$data);
            }
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }
    
    public function addPendonor(Request $request)
    {        
        $data_pendonor = Pendonor::create([
            'user_id' => $request->user_id,
            'ktp' => $request->ktp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'nama_ibu' => $request->nama_ibu,
            'status_nikah' => $request->status_nikah,
            'phone' => $request->phone,
            'gol_dar' => $request->gol_dar,
            'rhesus' => $request->rhesus,
        ]);
        
        if($data_pendonor){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function updatePendonor(Request $request)
    {
        $data_pendonor = Pendonor::find($request->id);
        $data_pendonor->user_id = $request->user_id;
        $data_pendonor->ktp = $request->ktp;
        $data_pendonor->nama = $request->nama;
        $data_pendonor->alamat = $request->alamat;
        $data_pendonor->jenis_kelamin = $request->jenis_kelamin;
        $data_pendonor->tempat_lahir = $request->tempat_lahir;
        $data_pendonor->tanggal_lahir = $request->tanggal_lahir;
        $data_pendonor->pekerjaan = $request->pekerjaan;
        $data_pendonor->nama_ibu = $request->nama_ibu;
        $data_pendonor->status_nikah = $request->status_nikah;
        $data_pendonor->phone = $request->phone;
        $data_pendonor->gol_dar = $request->gol_dar;
        $data_pendonor->rhesus = $request->rhesus;
        $data_pendonor->save();
        
        if($data_pendonor){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }


    // Pengajuan Jadwal

    public function createPengajuan(Request $request)
    {
        $data_jadwal = Pengajuan::create([
            'user_id' => $request->user_id,
            'nama_tempat' => $request->nama_tempat,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'alamat' => $request->alamat,
            'penanggung_jawab' => $request->penanggung_jawab,
            'status' => 'pending',
        ]);
        
        if($data_jadwal){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function getPengajuan(Request $request)
    {
        $user_id = $request->user_id;
        $query = Pengajuan::where('user_id',$user_id)->where('status', '!=', 'diterima')->get();
        if($query){
            $result["read"] = [];
            foreach($query as $u){
                $data = [
                    'id' => $u->id,
                    'user_id' => $u->user_id,
                    'nama_tempat' => $u->nama_tempat,
                    'hari' => $u->hari,
                    'tanggal' => $u->tanggal,
                    'jam_mulai' => $u->jam_mulai,
                    'jam_selesai' => $u->jam_selesai,
                    'alamat' => $u->alamat,
                    'penanggung_jawab' => $u->penanggung_jawab,
                    'foto' => url('/uploads/'.$u->foto),
                    'status' => ucwords($u->status),
                ];
                array_push($result["read"],$data);
            }
                $result["success"] = "1";
                $result["message"] = "success";
                echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function updatePengajuan(Request $request)
    {
        $pengajuan = Pengajuan::find($request->id);
        $pengajuan->user_id = $request->user_id;
        $pengajuan->nama_tempat = $request->nama_tempat;
        $pengajuan->hari = $request->hari;
        $pengajuan->tanggal = $request->tanggal;
        $pengajuan->jam_mulai = $request->jam_mulai;
        $pengajuan->jam_selesai = $request->jam_selesai;
        $pengajuan->alamat = $request->alamat;
        $pengajuan->penanggung_jawab = $request->penanggung_jawab;
        $pengajuan->save();
        
        if($pengajuan){
            $result["success"] = "1";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "error";
            echo json_encode($result);
        }
    }

    public function deletePengajuan(Request $request)
    {
        $id = $request->id;
        $delete = Pengajuan::where('id',$id)->delete();
        if($delete){
            $result["success"] = "true";
            $result["message"] = "success";
            echo json_encode($result);
        }else{
            $result["success"] = "false";
            $result["message"] = "Failed";
            echo json_encode($result);
        }
    }    
}
