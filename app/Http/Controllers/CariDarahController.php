<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockDarah;
use DataTables;

class CariDarahController extends Controller
{
    public function index()
    {
        return view('dashboard.rs.cari_darah.all');
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
                    return '<a href="' . route('order.checkout',$stock->id) . '" class="btn btn-primary btn-xs bg-blue">
                    <span class="fa fa-external-link" style="margin-right:5px;"> </span> Order Darah</a>';
                })
                ->rawColumns(['gol_dar','jenis_tranfusi','qty','harga','action'])
                ->addIndexColumn()
                ->make(true);
    }
}
