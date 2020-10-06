<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;
use Carbon\Carbon;

class JadwalController extends Controller
{

    public function __construct()
    {        
        $dateNow = Carbon::now()->format('Y-m-d');
        $schedulles = Jadwal::whereDate('tanggal','<=',$dateNow)->get();
        foreach ($schedulles as $schedulle) {
            $schedulle->update([
                'status' => 'selesai',
            ]);
        }
    }
    
    public function index()
    {
        return view('dashboard.jadwal.all');
    }

    public function create()
    {
        return view('dashboard.jadwal.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.'
        ];

        $customAttributes = [
            'nama_tempat' => 'Nama Lokasi',
            //'hari' => 'Hari',
            'tanggal' => 'Tanggal',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'alamat' => 'Alamat Lokasi',
            'foto' => 'Foto Lokasi',
        ];

        $valid = $request->validate([
            'nama_tempat' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            //'hari' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'alamat' => 'required',
            'foto' => 'required'
        ],$messages,$customAttributes);


        
        if($valid == true){            
            //cek foto
            $cover = $request->file('foto');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
            $dayEnglish = Carbon::now()->format('l');
            $data_jadwal = new Jadwal([
                'nama_tempat' => $request->get('nama_tempat'),
                //'hari' => $request->get('hari'),
                'hari' => Carbon::create($request->tanggal)->locale('id_ID')->dayName,
                'tanggal' => Carbon::parse($request->tanggal)->format('Y-m-d'),
                'jam_mulai' => $request->get('jam_mulai'),
                'jam_selesai' => $request->get('jam_selesai'),
                'alamat' => $request->get('alamat'),
                'foto' => $cover->getFilename().'.'.$extension,
                // 'status' =>
            ]);
            
            $data_jadwal->save();
            
            return redirect()->route('jadwal.index')->with('success','Jadwal berhasil dibuat.');
        }
        else {
            return view('dashboard.jadwal.create')->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['jadwal'] = Jadwal::find($id);

        return view('dashboard.jadwal.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.'
        ];

        $customAttributes = [
            'nama_tempat' => 'Nama Lokasi',
            'hari' => 'Hari',
            'tanggal' => 'Tanggal',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'alamat' => 'Alamat Lokasi',
            'foto' => 'Foto Lokasi'
        ];

        $valid = $request->validate([
            'nama_tempat' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'hari' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'alamat' => 'required'
        ],$messages,$customAttributes);

        if($valid == true){
            $jadwal = Jadwal::find($id);
            $jadwal->nama_tempat = $request->nama_tempat;
            $jadwal->hari = $request->hari;
            $jadwal->tanggal = $request->tanggal;
            $jadwal->jam_mulai = $request->jam_mulai;
            $jadwal->jam_selesai = $request->jam_selesai;
            $jadwal->alamat = $request->alamat;  
            $jadwal->status = $request->status;
            $jadwal->save();
            
            return redirect()->route('jadwal.index')->with('success','Jadwal berhasil diubah.');
        }
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index');
    }

    public function getdata()
    {
        $query = Jadwal::select(['id','nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat', 'status', 'created_at'])->where('status',null);

        return DataTables::of($query)
                ->editColumn('nama', function ($jadwal) {
                    return $jadwal->nama_tempat;
                    })
                ->editColumn('hari_tanggal', function ($jadwal) {
                    return $jadwal->hari . ', ' . $jadwal->tanggal;
                    })
                ->editColumn('waktu', function ($jadwal) {
                    return $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai;
                    })
                ->editColumn('alamat', function ($jadwal){
                    return $jadwal->alamat;
                })
                ->editColumn('action', function ($jadwal) {
                    return '<a href="' . route('jadwal.edit',$jadwal->id) . '"><span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('jadwal.delete',['id'=>$jadwal->id]) . '" title="Delete"> <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
                })
                ->rawColumns(['nama','hari_tanggal','waktu','alamat','action'])
                ->addIndexColumn()
                ->make(true);
    }

    public function lapJadwal()
    {
        $data['jadwal_selesai'] = Jadwal::select(['id','nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat', 'status', 'created_at'])->where('status','selesai')->get();
        $data['jadwal_batal'] = Jadwal::select(['id','nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat', 'status', 'created_at'])->where('status','batal')->get();
        
        return view('dashboard.laporan.jadwal',$data);
    }
    
    public function cetak_jadwal_selesai()
    {
        $selesai = Jadwal::select(['id','nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat', 'status', 'created_at'])->where('status','selesai')->get();
        $pdf = PDF::loadview('dashboard.laporan.jadwal_selesai_pdf',['selesai'=>$selesai]);
        return $pdf->stream();
    }
    
    public function cetak_jadwal_batal()
    {
        $batal = Jadwal::select(['id','nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat', 'status', 'created_at'])->where('status','batal')->get();
        $pdf = PDF::loadview('dashboard.laporan.jadwal_batal_pdf',['batal'=>$batal]);
        return $pdf->stream();
    }
}
