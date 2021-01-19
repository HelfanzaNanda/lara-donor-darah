<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendonor;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\User;
use DataTables;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifButuhDarah;
use App\Mail\NotifLayakDonor;
use App\Mail\NotifTidakLayakDonor;
use App\Mail\NotifSelesaiDonor;
use Form;
use Collective\Html\FormFacade;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PendonorController extends Controller
{

    public function index()
    {
        return view('dashboard.pendonor.all');
    }

    public function create()
    {
        $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        return view('dashboard.pendonor.create', $data);
    }

    public function getKtp(Request $request)
    {
        //return $request->all();
        $nik = $request->nik;
        $url = "http://103.12.164.52:8185/ws_server/get_json/diskominfo/NEWNIK?USER_ID=kominfo&PASSWORD=123456&NIK=";
        $client = new Client();
        $response = $client->get($url.$nik);
        return $response->getBody();
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.',
            'numeric'  => ':attribute harus berupa karakter numerik',
            'ktp.digits_between' => ':attribute harus 16 karakter',
            'phone.digits_between' => ':attribute harus diantara 11 - 12',
            'in' => ':attribute harus di antara A,B,AB,O'
        ];

        $customAttributes = [
            'ktp' => 'Nomor KTP',
            'nama' => 'Nama',
            'kabupaten' => 'Kabupaten',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'alamat' => 'Alamat Pemdonor',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'pekerjaan' => 'Pekerjaan',
            'nama_ibu' => 'Nama Ibu Kandung',
            'status_nikah' => 'Status Nikah',
            'phone' => 'Nomor Telepon',
            'gol_dar' => 'Golongan Darah',
            //'rhesus' => 'Rhesus',
        ];

        $valid = $request->validate([
            // 'ktp' => 'required|numeric|digits_between:16,17',
            // 'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            // 'kabupaten' => 'required',
            // 'kecamatan' => 'required',
            // //'desa' => 'required',
            // 'alamat' => 'required',
            // 'jenis_kelamin' => 'required',
            // 'tempat_lahir' => 'required|regex:/^[\pL\s\-]+$/u',
            // 'tanggal_lahir' => 'required',
            // 'pekerjaan' => 'required|regex:/^[\pL\s\-]+$/u',
            // 'nama_ibu' => 'required|regex:/^[\pL\s\-]+$/u',
            // 'status_nikah' => 'required|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required|numeric|digits_between:11,13',
            'gol_dar' => 'required|in:A,B,AB,O',
            //'rhesus' => 'required'
        ],$messages,$customAttributes);

        if($valid == true){
            $data_pendonor = new Pendonor([
                'ktp' => $request->get('ktp'),
                'nama' => $request->get('nama'),
                'kabupaten' => $request->get('kabupaten'),
                'kecamatan' => $request->get('kecamatan'),
                'desa' => $request->get('kelurahan'),
                'alamat' => $request->get('alamat'),
                'jenis_kelamin' => $request->get('jenis_kelamin'),
                'tempat_lahir' => $request->get('tempat_lahir'),
                'tanggal_lahir' => $request->get('tanggal_lahir'),
                'pekerjaan' => $request->get('pekerjaan'),
                'nama_ibu' => $request->get('nama_ibu'),
                'status_nikah' => $request->get('status_menikah'),
                'phone' => $request->get('phone'),
                'gol_dar' => $request->get('gol_dar'),
                //'rhesus' => $request->get('rhesus'),
            ]);

            $data_pendonor->save();

            return redirect()->route('pendonor.index')->with('success','Pendonor berhasil ditambah.');
        }
        else {
            return view('dashboard.pendonor.create')->withInput();
        }
    }

    public function show($id)
    {
        $data['pendonor'] = Pendonor::find($id);
        $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        $data['kecamatan'] = Kecamatan::select(['id','nama'])->get();
        $data['desa'] = Desa::select(['id','nama'])->get();
        return view('dashboard.pendonor.view', $data);
    }

    public function edit($id)
    {
        $data['pendonor'] = Pendonor::find($id);
        $data['kabupaten'] = Kabupaten::select(['id','nama'])->get();
        $data['kecamatan'] = Kecamatan::select(['id','nama'])->get();
        $data['desa'] = Desa::select(['id','nama'])->get();
        return view('dashboard.pendonor.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.'
        ];

        $customAttributes = [
            'ktp' => 'Nomor KTP',
            'nama' => 'Nama',
            'kabupaten' => 'Kabupaten',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'alamat' => 'Alamat Pemdonor',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'pekerjaan' => 'Pekerjaan',
            'nama_ibu' => 'Nama Ibu Kandung',
            'status_nikah' => 'Status Nikah',
            'phone' => 'Nomor Telepon',
            'gol_dar' => 'Golongan Darah',
            'rhesus' => 'Rhesus',
        ];

        $valid = $request->validate([
            'ktp' => 'required|numeric',
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|regex:/^[\pL\s\-]+$/u',
            'tanggal_lahir' => 'required',
            'pekerjaan' => 'required|regex:/^[\pL\s\-]+$/u',
            'nama_ibu' => 'required|regex:/^[\pL\s\-]+$/u',
            'status_nikah' => 'required|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required|numeric',
            'gol_dar' => 'required',
            'rhesus' => 'required'
        ],$messages,$customAttributes);

        if($valid == true){
            $pendonor = Pendonor::find($id);
            $pendonor->ktp = $request->ktp;
            $pendonor->nama = $request->nama;
            $pendonor->kabupaten = $request->kabupaten;
            $pendonor->kecamatan = $request->kecamatan;
            $pendonor->desa = $request->desa;
            $pendonor->alamat = $request->alamat;
            $pendonor->jenis_kelamin = $request->jenis_kelamin;
            $pendonor->tempat_lahir = $request->tempat_lahir;
            $pendonor->tanggal_lahir = $request->tanggal_lahir;
            $pendonor->pekerjaan = $request->pekerjaan;
            $pendonor->nama_ibu = $request->nama_ibu;
            $pendonor->status_nikah = $request->status_nikah;
            $pendonor->phone = $request->phone;
            $pendonor->gol_dar = $request->gol_dar;
            $pendonor->rhesus = $request->rhesus;
            if($request->status_donor != null){
                $pendonor->status_donor = $request->status_donor;
            }
            $pendonor->save();

            if($pendonor->user_id != null){
                if($pendonor->status_donor == 'layak'){
                    $cek = Pendonor::find($pendonor->id);
                    $user = User::find($cek->user_id);
                    Mail::to($user->email)->send(new NotifLayakDonor($user, $cek));
                }

                if($pendonor->status_donor == 'belum layak'){
                    $cek = Pendonor::find($pendonor->id);
                    $user = User::find($cek->user_id);
                    Mail::to($user->email)->send(new NotifTidakLayakDonor($user, $cek));
                }
            }
            return redirect()->route('pendonor.index')->with('success','Pendonor berhasil diubah.');
        }
        else {
            return view('dashboard.pendonor.edit')->withInput();
        }
    }

    public function destroy($id)
    {
        $pendonor = Pendonor::find($id);
        $pendonor->delete();
        return redirect()->route('pendonor.index');
    }

    public function getdata()
    {
        $query = Pendonor::with(['cek_kabupaten','cek_kecamatan','cek_desa'])->select(['id','user_id','ktp','nama','kabupaten','kecamatan','desa','alamat','jenis_kelamin','tempat_lahir','tanggal_lahir','pekerjaan','nama_ibu','status_nikah','phone','gol_dar','rhesus', 'created_at']);
        // $query = DB::table('pendonor')
        // ->join('kabupaten', 'pendonor.kabupaten', '=', 'kabupaten.id')
        // ->join('kecamatan', 'pendonor.kecamatan', '=', 'kecamatan.id')
        // ->join('desa', 'pendonor.desa', '=', 'desa.id')
        // ->select('pendonor.*', 'kabupaten.nama as nama_kab', 'kecamatan.nama as nama_kec', 'desa.nama as nama_desa')
        // ->get();

        return DataTables::of($query)
                ->editColumn('nama', function ($pendonor) {
                    $output = '';
                    if($pendonor->jenis_kelamin == 'LAKI-LAKI'){
                        $output = '<a href="'.route('pendonor.show',$pendonor->id).'">' . ucwords($pendonor->nama) . '</a>  (<span class="text-green">L</span>)';
                    }else{
                        $output = '<a href="'.route('pendonor.show',$pendonor->id).'">' . ucwords($pendonor->nama) . '</a>  (<span class="text-navy">P</span>)';
                    }
                    return $output;
                })
                ->editColumn('alamat', function ($pendonor) {
                    if($pendonor->kabupaten == NULL){
                        $output = ucwords($pendonor->alamat);
                    }else{
                        $output = ucwords($pendonor->alamat) . ', <br>' . ucwords($pendonor->desa) . ', ' . ucwords($pendonor->kecamatan) . ', ' . ucwords($pendonor->kabupaten);
                    }
                    return $output;
                    })
                ->editColumn('ttl', function ($pendonor) {
                    return ucwords($pendonor->tempat_lahir) . ', ' . $pendonor->tanggal_lahir;
                    })
                ->editColumn('goldar', function ($pendonor){
                    return ucwords($pendonor->gol_dar) . ' (' . $pendonor->rhesus . ')';
                })
                ->editColumn('action', function ($pendonor) {
                    $output = '';
                    $output .= '<a href="' . route('pendonor.edit',$pendonor->id) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                <a type="javascript:;" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('pendonor.delete',['id'=>$pendonor->id]) . '" title="Delete"><i class="fa fa-trash"></i></a>';
                    if($pendonor->user_id != null){
                        $output .= '<form action="'.route('pendonor.butuhdarah').'" method="post">'.csrf_field().Form::hidden('id_pendonor', $pendonor->id).'<button type="submit" class="btn btn-success btn-xs bg-transparent" title="Kirim Notifikasi Butuh Darah"><i class="fa fa-mail-forward"></i> Send Notif</button></form>';
                    }

                    return $output;
                })
                ->rawColumns(['nama','alamat','ttl','goldar','action'])
                ->addIndexColumn()
                ->make(true);
    }

    public function getKecamatan($id)
    {
        // $kecamatan = Kecamatan::select(['kabupaten_id','nama'])->where('kabupaten_id', $id)->get();
        $kecamatan = DB::table("kecamatan")->where("kabupaten_id",$id)->pluck("nama","id");
        return json_encode($kecamatan);
    }

    public function getDesa($id)
    {
        // $kecamatan = Kecamatan::select(['kabupaten_id','nama'])->where('kabupaten_id', $id)->get();
        $desa = DB::table("desa")->where("kecamatan_id",$id)->pluck("nama","id");
        return json_encode($desa);
    }

    public function sendNotif(Request $request)
    {
        // $status = $request->status;
        $pendonor = Pendonor::find($request->id_pendonor);

        $user = User::find($pendonor->user_id);
        Mail::to($user->email)->send(new NotifButuhDarah($user, $pendonor));

        return redirect()->back()->with('success','Notifikasi telah di kirim ke '.$user->email);
    }

    public function sendStatus(Request $request)
    {
        // $status = $request->status;
        $pendonor = Pendonor::find($request->id_pendonor);

        $user = User::find($pendonor->user_id);
        Mail::to($user->email)->send(new NotifSelesaiDonor($user, $pendonor));

        return redirect()->back()->with('success','Notifikasi telah di kirim ke '.$user->email);
    }
}
