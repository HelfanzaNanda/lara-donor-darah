<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockDarah;
use App\Models\Permintaan;
use DB;
use DataTables;
use PDF;

class StockDarahController extends Controller
{

    public function index()
    {
        return view('dashboard.darah.stock.all');
    }
    
    public function create()
    {
        return view('dashboard.darah.stock.create');
    }
    
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.'
        ];

        $customAttributes = [
            'gol_dar' => 'Golongan Darah',
            'jenis_tranfusi' => 'Jenis Tranfusi Darah',
            'rhesus' => 'Rhesus',
            'qty' => 'Jumlah'
        ];

        $valid = $request->validate([
            'gol_dar' => 'required',
            'jenis_tranfusi' => 'required',
            'rhesus' => 'required',
            'qty' => 'required'
        ],$messages,$customAttributes);

        if($valid == true){            
            $stok = new StockDarah([
                'gol_dar' => $request->get('gol_dar'),
                'jenis_tranfusi' => $request->get('jenis_tranfusi'),
                'rhesus' => $request->get('rhesus'),
                'qty' => $request->get('qty'),
                'harga' => $request->get('harga')
            ]);
            
            $stok->save();
            
            return redirect()->route('stock.index')->with('success','Stok berhasil ditambah.');
        }
        else {
            return view('dashboard.stock.create')->withInput();
        }
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data['stok'] = StockDarah::find($id);
        return view('dashboard.darah.stock.edit', $data);
    }
    
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'qty_new' => 'required',
            'opsi' => 'required'
        ]);

        $opsi = $request->opsi;
        $qty_new = $request->qty_new;
        $qty_old = $request->qty_old;

        if($valid == true){
            if($opsi == 'penambahan'){
                $newQty = $qty_old + $qty_new;
            }else{
                $newQty = $qty_old - $qty_new;
            }
            $stok = StockDarah::find($id);
            $stok->jenis_tranfusi = $request->jenis_tranfusi;
            $stok->qty = $newQty;
            $stok->harga = $request->harga;
            $stok->save();
            
            return redirect()->route('stock.index')->with('success','Stok berhasil diubah.');
        }
    }
    
    public function destroy($id)
    {
        $stock = StockDarah::find($id);
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'Stok berhasil dihapus.');
    }

    public function getdata()
    {
        $query = StockDarah::select(['id','gol_dar', 'jenis_tranfusi', 'rhesus', 'qty', 'harga', 'created_at']);
        // $query = DB::table('stock_darah')
        // ->join('kabupaten', 'pendonor.kabupaten', '=', 'kabupaten.id')
        // ->join('kecamatan', 'pendonor.kecamatan', '=', 'kecamatan.id')
        // ->join('desa', 'pendonor.desa', '=', 'desa.id')
        // ->select('pendonor.*', 'kabupaten.nama as nama_kab', 'kecamatan.nama as nama_kec', 'desa.nama as nama_desa')
        // ->get();

        return DataTables::of($query)
                ->editColumn('gol_dar', function ($stock) {
                    return $stock->gol_dar . ' (' . $stock->rhesus . ')';
                    })
                ->editColumn('jenis_tranfusi', function ($stock) {
                    return $stock->jenis_tranfusi;
                    })
                ->editColumn('qty', function ($stock){
                    return $stock->qty;
                })
                ->editColumn('harga', function ($stock){
                    return 'Rp. '.$stock->harga;
                })
                ->editColumn('action', function ($stock) {
                    return '<a href="' . route('stock.edit',$stock->id) . '" class="btn btn-primary btn-xs bg-blue">
                    <span class="fa fa-pencil" style="margin-right:5px;"> </span> Edit Stok</a> | 
                    <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" class="btn btn-danger btn-xs bg-red" data-href="' . route('stock.delete',['id'=>$stock->id]) . '" title="Delete"> 
                    <span class="fa fa-trash" style="margin-left:5px;"> </span> Hapus</a>';
                })
                ->rawColumns(['gol_dar','jenis_tranfusi','qty','harga','action'])
                ->addIndexColumn()
                ->make(true);
    }

    public function stockChange()
    {
        $data['stock'] = StockDarah::all();
        return view('dashboard.darah.stock.change', $data);
    }

    public function stockChangeUpdate()
    {
        
    }

    //Laporan Darah
    public function lapDarah()
    {
        // $query = Order::select(['status', DB::raw('COUNT(status) AS total')])
        //             ->where('created_at', '>=', $query_string['from_date'])
        //             ->where('created_at', '<', $until);

        // if ($user->role == 'cs') {
        //     $query = $query->where('operator_id', $user->id);
        // } elseif ($user->role == 'cc') {
        //     $query = $query->where('cc_id', $user->id);
        // } elseif ($user->role == 'adv') {
        //     $query = $query->where('ads_id', $user->id);
        // }

        // $data = $query->groupBy('status')->get();

        $data['lapDarah'] = Permintaan::select(['darah_id', DB::raw('COUNT(darah_id) AS goldar')])->groupBy('darah_id')->get();
        // dd($data['lapDarah']);
        return view('dashboard.laporan.darah',$data);
    }
    
    public function cetak_lapKeluar()
    {
        $lapkeluar = Permintaan::select(['darah_id', DB::raw('COUNT(darah_id) AS goldar')])->groupBy('darah_id')->get();
        $pdf = PDF::loadview('dashboard.laporan.darah_keluar_pdf',['lapkeluar'=>$lapkeluar]);
        return $pdf->stream();
    }

    public function cetak_lapMasuk()
    {
        $lapmasuk = StockDarah::all();
        $pdf = PDF::loadview('dashboard.laporan.darah_masuk_pdf',['lapmasuk'=>$lapmasuk]);
        return $pdf->stream();
    }

    public function getDarah()
    {
        $query = StockDarah::select(['id','gol_dar', 'jenis_tranfusi', 'rhesus', 'qty', 'harga', 'created_at']);
        // $query = DB::table('stock_darah')
        // ->join('kabupaten', 'pendonor.kabupaten', '=', 'kabupaten.id')
        // ->join('kecamatan', 'pendonor.kecamatan', '=', 'kecamatan.id')
        // ->join('desa', 'pendonor.desa', '=', 'desa.id')
        // ->select('pendonor.*', 'kabupaten.nama as nama_kab', 'kecamatan.nama as nama_kec', 'desa.nama as nama_desa')
        // ->get();

        return DataTables::of($query)
                ->editColumn('gol_dar', function ($stock) {
                    return $stock->gol_dar . ' (' . $stock->rhesus . ')';
                    })
                ->editColumn('jenis_tranfusi', function ($stock) {
                    return $stock->jenis_tranfusi;
                    })
                ->editColumn('qty', function ($stock){
                    return $stock->qty;
                })
                ->editColumn('harga', function ($stock){
                    return 'Rp. '.$stock->harga;
                })
                ->editColumn('action', function ($stock) {
                    return '<a href="' . route('stock.edit',$stock->id) . '" class="btn btn-primary btn-xs bg-blue">
                    <span class="fa fa-pencil" style="margin-right:5px;"> </span> Edit Stok</a> | 
                    <a type="javascript:;" data-toggle="modal" data-target="#konfirmasi_hapus" class="btn btn-danger btn-xs bg-red" data-href="' . route('stock.delete',['id'=>$stock->id]) . '" title="Delete"> 
                    <span class="fa fa-trash" style="margin-left:5px;"> </span> Hapus</a>';
                })
                ->rawColumns(['gol_dar','jenis_tranfusi','qty','harga','action'])
                ->addIndexColumn()
                ->make(true);
    }
}
