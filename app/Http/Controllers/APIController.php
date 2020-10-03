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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgotPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class APIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['profile', 'updateUser', 'upload',
        'getPendonor', 'getPengajuan', 'createPengajuan', 'addPendonor']);
    }

    public function userRegister(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'phone'      => "08923423455",
            //'role'       => 'pendonor',
            'role'       => $request->role,
            'password'   => Hash::make($request->password),
            'api_token'  => Str::random(80)
        ]);

        if($user){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
            
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function userLogin(Request $request)
    {
        $input = $request->all();

        //$role = "pendonor";
        $role = $request->role;
        
        $credential = [
            'email' => $request->email,
            'password' => $request->password,

        ];

        if (Auth::guard('web')->attempt($credential)){
            $user = Auth::guard('web')->user();
            if ($user->email_verified_at !== null){
                return response()->json([
                    'message' => 'Login Successfully',
                    'status' => true,
                    'data' => $user,
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Silahkan Aktifasi Email Dahulu',
                    'status' => false,
                    'data' => []
                ], 401);
            }
        }
        return response()->json([
            'message' => 'Masukan Email dan Password yang benar',
            'status' => false,
            'data' => (object)[]
        ], 401);
    }

    public function profile()
    {
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => Auth::user(),
        ], 200);
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->foto = $request->foto;
        $user->save();

        if($user){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function upload(Request $request)
    {
        $getId = $request->id;
        $cover = $request->file('foto');
        $extension = $cover->getClientOriginalExtension();

        Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

        $user = Auth::user();
        $user->foto = $cover->getFileName().'.'.$extension;
        $user->save();

        if($user){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $id = $request->id;
        $user = User::where('email',$email)->first();

        $send = Mail::to($user->email)->send(new SendForgotPassword($user));
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => (object)[]
        ]);
    }

    //Json data Informasi

    public function getInformation()
    {
        $getInformation = Information::where('kategori','informasi')->get();
        if($getInformation){
            // jika ada data, buat variabel read untuk menampung data array
            $result = [];
            // tampilkan data aja yang mau di tampilkan dengan foreach
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "title" => $u->title,
                    "image" => url('/uploads/'.$u->image),
                    "category" => $u->kategori,
                    "content" => $u->content,
                ];
                //tampung data yang diatas ke variabel read
                array_push($result,$data);
            }
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => $result
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => true,
                'data' => (object)[]
            ]);
        }
    }

    public function getBerita()
    {
        $getInformation = Information::where('kategori','berita')->get();
        if($getInformation){
            $result = [];
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "title" => $u->title,
                    "image" => url('/uploads/'.$u->image),
                    "category" => $u->kategori,
                    "content" => $u->content,
                ];
                array_push($result,$data);
            }
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => $result
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function getJadwal()
    {
        $getInformation = Jadwal::orderBy('tanggal', 'ASC')->get();
        if($getInformation){
            $result = [];
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
                array_push($result,$data);
            }
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => $result
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }


    public function getStockDarah()
    {
        $getInformation = StockDarah::orderBy('gol_dar','ASC')->get();
        if($getInformation){
            $result = [];
            foreach($getInformation as $u){
                $data = [
                    "id" => $u->id,
                    "gol_dar" => $u->gol_dar,
                    "rhesus" => $u->rhesus,
                    "jenis_tranfusi" => $u->jenis_tranfusi,
                    "qty" => $u->qty,
                ];
                array_push($result,$data);
            }
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => $result
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }


    public function getPendonor()
    {
        $id = Auth::user()->id;
        $getPendonor = Pendonor::where('user_id', $id)->get();
        if($getPendonor){
            $result = [];
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
                array_push($result,$data);
            }

            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => $result
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function addPendonor(Request $request)
    {
        $data_pendonor = Pendonor::create([
            'user_id' => Auth::user()->id,
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
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function updatePendonor(Request $request, $id)
    {
        $data_pendonor = Pendonor::find($id);
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
        $data_pendonor->update();

        if($data_pendonor){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }


    // Pengajuan Jadwal

    public function createPengajuan(Request $request)
    {
        $data_jadwal = Pengajuan::create([
            'user_id' => Auth::user()->id,
            'nama_tempat' => $request->nama_tempat,
            'nama_acara' => $request->nama_acara,
            'jumlah_peserta' => $request->jumlah_peserta,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'alamat' => $request->alamat,
            'penanggung_jawab' => $request->penanggung_jawab,
            'status' => 'pending',
        ]);

        if($data_jadwal){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function getPengajuan()
    {
        $id = Auth::user()->id;
        $query = Pengajuan::where('user_id',$id)->where('status', '!=', 'diterima')->get();
        if($query){
            $result = [];
            foreach($query as $u){
                $data = [
                    'id' => $u->id,
                    'user_id' => $u->user_id,
                    'nama_tempat' => $u->nama_tempat,
                    'nama_acara' => $u->nama_acara,
                    'jumlah_peserta' => $u->jumlah_peserta,
                    'hari' => $u->hari,
                    'tanggal' => $u->tanggal,
                    'jam_mulai' => $u->jam_mulai,
                    'jam_selesai' => $u->jam_selesai,
                    'alamat' => $u->alamat,
                    'penanggung_jawab' => $u->penanggung_jawab,
                    'foto' => url('/uploads/'.$u->foto),
                    'status' => ucwords($u->status),
                ];
                array_push($result,$data);
            }
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => $result
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function updatePengajuan(Request $request, $id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->nama_tempat = $request->nama_tempat;
        $pengajuan->nama_acara = $request->nama_acara;
        $pengajuan->jumlah_peserta = $request->jumlah_peserta;
        $pengajuan->hari = $request->hari;
        $pengajuan->tanggal = $request->tanggal;
        $pengajuan->jam_mulai = $request->jam_mulai;
        $pengajuan->jam_selesai = $request->jam_selesai;
        $pengajuan->alamat = $request->alamat;
        $pengajuan->penanggung_jawab = $request->penanggung_jawab;
        $pengajuan->update();

        if($pengajuan){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }

    public function deletePengajuan($id)
    {
        $delete = Pengajuan::where('id',$id)->delete();
        if($delete){
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);
        }else{
            return response()->json([
                'message' => 'error',
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }
}
