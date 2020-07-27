<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockDarah;
use App\Models\Permintaan;
use App\Models\Pembayaran;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class PermintaanController extends Controller
{

    public function index()
    {
        return view('dashboard.darah.permintaan.all');
    }

    public function create()
    {
        return view('dashboard.rs.order.create');
    }

    public function store(Request $request)
    {
        //
    }

    // Proses PMI
    public function proses($id)
    {
        $data['permintaan'] = Permintaan::find($id);
        $data['pembayaran'] = Pembayaran::where('permintaan_id',$id)->first();
        return view('dashboard.darah.permintaan.view',$data);
    }
    
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.'
        ];

        $customAttributes = [
            'status_permintaan' => 'Status Permintaan',
        ];

        $valid = $request->validate([
            'status_permintaan' => 'required',
        ],$messages,$customAttributes);
    
        if($valid == true){
            if($request->status_pengiriman == NULL){
                $data_permintaan = Permintaan::find($id);
                $data_permintaan->status_permintaan = $request->status_permintaan;
                $data_permintaan->status_pembayaran = 'belum dibayar';
                $data_permintaan->save();
            }else{
                $data_permintaan = Permintaan::find($id);
                $data_permintaan->status_permintaan = $request->status_permintaan;
                $data_permintaan->status_pengiriman = $request->status_pengiriman;
                $data_permintaan->save();
            }
            
            return redirect()->route('permintaan.index')->with('success','Pesanan Darah berhasil diubah.');
        }
    }

    // Checkout
    // public function edit($id)
    // {
    //     $data['stock'] = StockDarah::find($id);
    //     return view('dashboard.rs.order.checkout', $data);
    // }


    public function destroy($id)
    {
        //
    }

    public function getDataPermintaan()
    {
        $query = Permintaan::with(['darah','pembayaran'])->select(['id', 'user_id', 'darah_id', 'nama_pasien', 'jenis_kelamin', 'ruangan', 'diagnosa', 'jumlah', 'tempat', 'tanggal', 'nama_dokter','status_permintaan','status_pembayaran','status_pengiriman','created_at']);

        return DataTables::of($query) 
                ->editColumn('pasien', function ($order) {
                    $output = '<span class="text-black">'.$order->nama_pasien.' ('.$order->jenis_kelamin.')</span><br>';
                    $output .= '<span class="text-warning">'.$order->diagnosa.', <b>'.$order->ruangan.'</b></span>';
                    
                    return $output;
                })
                ->editColumn('gol_dar', function ($order) {
                    $output = '<span class="text-black">Golongan Darah : '.$order->darah->gol_dar.' ('.$order->darah->rhesus.')</span><br>';
                    $output .= '<span class="text-warning">'.$order->darah->jenis_tranfusi.' </b></span>';
                    
                    return $output;
                })
                ->editColumn('qty', function ($order){
                    return '<span class="text-black"><b>'.$order->jumlah.' </b> Kantong</span>';
                })
                ->editColumn('status', function ($order){
                    if($order->status_permintaan == 'pending'){
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#f1c40f;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }elseif($order->status_permintaan == 'success'){
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#0e9a2e;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }elseif($order->status_permintaan == 'process'){
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#0e9a2e;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }else{
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#f10e13;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }
                    return $output;
                })
                ->editColumn('pembayaran', function ($order){
                    if($order->status_pembayaran == 'belum dibayar'){
                        $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" style="color:#f1c40f;"></li></small> '.ucwords($order->status_pembayaran).'</div>';
                    }elseif($order->status_pembayaran == 'sudah dibayar'){
                        $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" style="color:#0e9a2e;"></li></small> '.ucwords($order->status_pembayaran).'</div>';
                    }else{
                        $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" style="color:#000000;"></li></small> ---------- </div>';
                    }
                    return $output;
                })
                ->editColumn('dokter', function ($order){
                    return $order->nama_dokter;
                })
                ->editColumn('action', function ($order) {
                    return '<a href="'.route('permintaan.proses',$order->id).'" class="btn btn-primary btn-xs bg-blue">
                    <span class="fa fa-external-link" style="margin-right:5px;"> </span> Proses</a>';
                })
                ->rawColumns(['pasien','gol_dar','qty','status','dokter','pembayaran','action'])
                ->addIndexColumn()
                ->make(true);
    }

    // RS
    public function getAll()
    {
        $check_id = auth()->user()->id;
        $data['order'] = Permintaan::find($check_id);
        return view('dashboard.rs.order.all', $data);
    }

    public function checkout($id)
    {
        $data['stock'] = StockDarah::find($id);
        return view('dashboard.rs.order.checkout', $data);
    }

    public function storeCheckout(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong.',
            'regex'    => ':attribute harus berupa karakter alphabet.'
        ];

        $customAttributes = [
            'nama_pasien' => 'Nama Pasien',
            'jenis_kelamin' => 'Jenis Kelamin',
            'ruangan' => 'Nama Ruangan',
            'diagnosa' => 'Diagnosa',
            'jumlah' => 'Jumlah darah',
            'tempat' => 'Tempat',
            'tanggal' => 'Tanggal',
            'nama_dokter' => 'Nama Dokter',
        ];

        $valid = $request->validate([
            'nama_pasien' => 'required|regex:/^[\pL\s\-]+$/u',
            'jenis_kelamin' => 'required',
            'ruangan' => 'required',
            'diagnosa' => 'required',
            'jumlah' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
            'nama_dokter' => 'required'
        ],$messages,$customAttributes);
    
        if($valid == true){            
            $user_id = auth()->user()->id;
            $stock = StockDarah::find($request->id);
            $data_permintaan = new Permintaan([
                'user_id' => $user_id,
                'darah_id' => $request->get('darah_id'),
                'nama_pasien' => $request->get('nama_pasien'),
                'jenis_kelamin' => $request->get('jenis_kelamin'),
                'ruangan' => $request->get('ruangan'),
                'diagnosa' => $request->get('diagnosa'),
                'harga' => $request->get('harga'),
                'jumlah' => $request->get('jumlah'),
                'tempat' => $request->get('tempat'),
                'tanggal' => Carbon::parse($request->get('tanggal'))->format('y/m/d'),
                'nama_dokter' => $request->get('nama_dokter'),
                'status_permintaan' => "pending",
            ]);
            
            $data_permintaan->save();
            
            return redirect()->route('order.all')->with('success','Pesanan Darah berhasil dibuat.');
        }
    }

    public function editCheckout($id)
    {
        $data['order'] = Permintaan::find($id);
        $data['pembayaran'] = Pembayaran::where('permintaan_id',$id)->first();
        return view('dashboard.rs.order.edit',$data);
    }

    public function updateCheckout(Request $request,$id)
    {
        $valid = $request->validate([
            'permintaan_id' => 'required',
            'tanggal_pembayaran' => 'required',
            'status_pembayaran' => 'required'
        ]);
    
        if($valid == true){            
            $user_id = auth()->user()->id;
            if($request->bukti_pembayaran != NULL){
                $cover = $request->file('bukti_pembayaran');
                $extension = $cover->getClientOriginalExtension();
                Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
                if($request->id_pembayaran != NULL){
                    $data_pembayaran = Pembayaran::find($request->id_pembayaran);
                    $data_pembayaran->permintaan_id = $request->permintaan_id;
                    $data_pembayaran->user_id = $user_id;
                    $data_pembayaran->tipe_pembayaran = $request->tipe_pembayaran;
                    $data_pembayaran->bukti_pembayaran = $cover->getFilename().'.'.$extension;
                    $data_pembayaran->tanggal_pembayaran = Carbon::parse($request->tanggal_pembayaran)->format('y/m/d');
                    $data_pembayaran->total_pembayaran = $request->total_pembayaran;
                    $data_pembayaran->save();
    
               }else{ 
                   $data_pembayaran = new Pembayaran([
                       'permintaan_id' => $request->permintaan_id,
                       'user_id' => $user_id,
                       'tipe_pembayaran' => $request->tipe_pembayaran,
                       'bukti_pembayaran' => $cover->getFilename().'.'.$extension,
                       'tanggal_pembayaran' => Carbon::parse($request->tanggal_pembayaran)->format('y/m/d'),
                       'total_pembayaran' => $request->total_pembayaran,
                       ]);
                       $data_pembayaran->save();
                }
            }else{
                if($request->id_pembayaran != NULL){
                    $data_pembayaran = Pembayaran::find($request->id_pembayaran);
                    $data_pembayaran->permintaan_id = $request->permintaan_id;
                    $data_pembayaran->user_id = $user_id;
                    $data_pembayaran->tipe_pembayaran = $request->tipe_pembayaran;
                    $data_pembayaran->tanggal_pembayaran = Carbon::parse($request->tanggal_pembayaran)->format('y/m/d');
                    $data_pembayaran->total_pembayaran = $request->total_pembayaran;
                    $data_pembayaran->save();
    
               }else{ 
                   $data_pembayaran = new Pembayaran([
                       'permintaan_id' => $request->permintaan_id,
                       'user_id' => $user_id,
                       'tipe_pembayaran' => $request->tipe_pembayaran,
                       'bukti_pembayaran' => $cover->getFilename().'.'.$extension,
                       'tanggal_pembayaran' => Carbon::parse($request->tanggal_pembayaran)->format('y/m/d'),
                       'total_pembayaran' => $request->total_pembayaran,
                       ]);
                       $data_pembayaran->save();
                }
            }
            if($request->status_penerima != NULL){
                $data_permintaan = Permintaan::find($id);
                $data_permintaan->status_permintaan = "success";
                $data_permintaan->status_penerima = $request->status_penerima;
                $data_permintaan->save();
            }
            $data_permintaans = Permintaan::find($id);
            $data_permintaans->status_pembayaran = $request->status_pembayaran;
            $data_permintaans->save();
            
            if($request->status_pembayaran == 'sudah dibayar'){
                $data_stok = StockDarah::find($request->darah_id);
                $cek = $data_stok->qty;
                // dd($cek);
                $data_stok->qty = $cek - $request->jumlah;
                $data_stok->save();
            }
            
            
            return redirect()->route('order.all')->with('success','Pesanan Darah berhasil diubah.');
        }
    }

    public function getData()
    {
        $check_id = auth()->user()->id;
        $query = Permintaan::with('darah')->select(['id', 'user_id', 'darah_id', 'nama_pasien', 'jenis_kelamin', 'ruangan', 'diagnosa', 'jumlah', 'tempat', 'tanggal', 'nama_dokter','status_permintaan','status_pembayaran','status_pengiriman','created_at'])->where('user_id', $check_id);

        return DataTables::of($query)
                ->editColumn('pasien', function ($order) {
                    $output = '<span class="text-black">'.$order->nama_pasien.' ('.$order->jenis_kelamin.')</span><br>';
                    $output .= '<span class="text-warning">'.$order->diagnosa.', <b>'.$order->ruangan.'</b></span>';
                    
                    return $output;
                })
                ->editColumn('gol_dar', function ($order) {
                    $output = '<span class="text-black">Golongan Darah : '.$order->darah->gol_dar.' ('.$order->darah->rhesus.')</span><br>';
                    $output .= '<span class="text-warning">'.$order->darah->jenis_tranfusi.' </b></span>';
                    
                    return $output;
                })
                ->editColumn('qty', function ($order){
                    return '<span class="text-black"><b>'.$order->jumlah.' </b> Kantong</span>';
                })
                ->editColumn('status', function ($order){
                    if($order->status_permintaan == 'pending'){
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#f1c40f;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }elseif($order->status_permintaan == 'process'){
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#0e9a2e;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }elseif($order->status_permintaan == 'success'){
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#0e9a2e;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }else{
                        $output = '<div class="small text-muted">Status Permintaan </div><div> <small><li class="fa fa-circle fa-xs" style="color:#f10e13;"></li></small> '.ucwords($order->status_permintaan).'</div>';
                    }
                    return $output;
                })
                ->editColumn('pembayaran', function ($order){
                    if($order->status_pembayaran == 'belum dibayar'){
                        $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" style="color:#f1c40f;"></li></small> '.ucwords($order->status_pembayaran).'</div>';
                    }elseif($order->status_pembayaran == 'sudah dibayar'){
                        $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" style="color:#0e9a2e;"></li></small> '.ucwords($order->status_pembayaran).'</div>';
                    }else{
                        $output = '<div class="small text-muted">Status Pembayaran </div><div> <small><li class="fa fa-circle fa-xs" style="color:#000000;"></li></small> ---------- </div>';
                    }
                    return $output;
                })
                ->editColumn('dokter', function ($order){
                    return $order->nama_dokter;
                })
                ->editColumn('action', function ($order) {
                    return '<a href="'.route('order.editCheckout', $order->id).'" class="btn btn-primary btn-xs bg-blue">
                    <span class="fa fa-eye" style="margin-right:5px;"> </span></a>';
                })
                ->rawColumns(['pasien','gol_dar','qty','status','pembayaran','action'])
                ->addIndexColumn()
                ->make(true);
    }
}
