<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InformasiController extends Controller
{

    public function index()
    {
        return view('dashboard.informasi.all');
    }

    public function create()
    {
        return view('dashboard.informasi.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.'
        ];

        $customAttributes = [
            'title' => 'Judul',
            'image' => 'Gambar',
            'kategori' => 'Kategori',
            'content' => 'Konten',
        ];

        $valid = $request->validate([
            'title' => 'required',
            // 'image' => 'required',
            'kategori' => 'required',
            'content' => 'required'
        ],$messages,$customAttributes);

        if($valid == true){            
            //cek foto
            $cover = $request->file('foto');
            $extension = $cover->getClientOriginalExtension();

            Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

            $informasi = new Information([
                'title' => $request->get('title'),
                'image' => $cover->getFileName().'.'.$extension,
                'kategori' => $request->get('kategori'),
                'content' => $request->get('content')
            ]);
            
            $informasi->save();
            
            return redirect()->route('informasi.index')->with('success','Informasi berhasil dibuat.');
        }
        else {
            return view('dashboard.informasi.create')->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getData()
    {
        $query = Information::select(['id','title','image','kategori','content','created_at']);

        return DataTables::of($query)
            ->editColumn('title', function ($information) {
                return $information->title;
                })
            ->editColumn('kategori', function ($information) {
                return $information->kategori;
                })
            ->editColumn('content', function ($information) {
                return $information->content;
                })
            ->editColumn('action', function ($information) {
                return '<a href="' . route('informasi.edit',$information->id) . '">
                <span class="fa fa-pencil" style="margin-right:5px;"> </span> </a> | 
                <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="' . route('informasi.delete',['id'=>$information->id]) . '" title="Delete"> 
                <span class="fa fa-trash" style="margin-left:5px;"> </span></a>';
            })
            ->rawColumns(['title','kategori','content','action'])
            ->addIndexColumn()
            ->make(true);
    }
}
