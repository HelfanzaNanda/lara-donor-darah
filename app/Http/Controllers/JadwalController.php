<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use DataTables;

class JadwalController extends Controller
{
    
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
            'hari' => 'Hari',
            'tanggal' => 'Tanggal',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'alamat' => 'Alamat Lokasi',
            'foto' => 'Foto Lokasi',
        ];

        $valid = $request->validate([
            'nama_tempat' => 'required|regex:/^[\pL\s\-]+$/u',
            'hari' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'alamat' => 'required',
            'foto' => 'required'
        ],$messages,$customAttributes);


        
        if($valid == true){
            $resorce       = $request->file('foto');
            $ekstensi_foto   = $resorce->getClientOriginalExtension();
            $nama_foto = $resorce . "." . $ekstensi_foto;
            $path       = 'public/jadwal/'.$nama_foto;
            $resorce->move($path);
            
            $data_jadwal = new Jadwal([
                'nama_tempat' => $request->get('nama_tempat'),
                'hari' => $request->get('hari'),
                'tanggal' => $request->get('tanggal'),
                'jam_mulai' => $request->get('jam_mulai'),
                'jam_selesai' => $request->get('jam_selesai'),
                'alamat' => $request->get('alamat'),
                'foto' => $nama_foto
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
            'nama_tempat' => 'required|regex:/^[\pL\s\-]+$/u',
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
        $query = Jadwal::select(['id','nama_tempat','hari','tanggal','jam_mulai','jam_selesai','alamat', 'created_at']);

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
}
