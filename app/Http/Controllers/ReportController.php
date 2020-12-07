<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $auth = Auth::user();

        $datas = Permintaan::where('user_id', $auth->id)->get();

        return view('dashboard.rs.report.index', [
            'months' => $months,
            'datas' => $datas
        ]);
    }

    public function search(Request $request)
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $datas = Permintaan::whereMonth('tanggal', $request->month)->get();

        return view('dashboard.rs.report.index', [
            'months' => $months,
            'datas' => $datas,
            'numberMonth' => $request->month,
        ]);
        
    }

    public function pdf(Request $request)
    {
        
        $datas = Permintaan::whereMonth('tanggal', $request->month)->get();
    
        $month = Carbon::createFromFormat('m', $request->month)->monthName;

        $pdf = PDF::loadview('dashboard.rs.report.pdf', [
            'datas' => $datas,
            'month' => $month
        ]);
        
    	return $pdf->download('Laporan RS');
    }
}
