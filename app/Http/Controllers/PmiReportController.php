<?php

namespace App\Http\Controllers;

use App\Models\Pendonor;
use App\Models\Permintaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PmiReportController extends Controller
{
    public function rs()
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $datas = Permintaan::all();

        return view('dashboard.report.rs',[
            'datas' => $datas,
            'months' => $months,
            'numberMonth' => 0
        ]);
    }

    public function pengguna()
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $datas = Pendonor::all();

        return view('dashboard.report.pengguna', [
            'datas' => $datas,
            'months' => $months,
            'numberMonth' => 0
        ]);
    }

    public function penggunaSearch(Request $request)
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $datas = Pendonor::whereMonth('created_at', $request->month)->get();

        return view('dashboard.report.pengguna', [
            'months' => $months,
            'datas' => $datas,
            'numberMonth' => $request->month,
        ]);
        
    }

    public function rsSearch(Request $request)
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $datas = Permintaan::whereMonth('tanggal', $request->month)->get();

        return view('dashboard.report.rs', [
            'months' => $months,
            'datas' => $datas,
            'numberMonth' => $request->month,
        ]);
        
    }

    public function rsPdf(Request $request)
    {
        
        $datas = Permintaan::whereMonth('tanggal', $request->month)->get();
    
        $month = Carbon::createFromFormat('m', $request->month)->monthName;

        $pdf = PDF::loadview('dashboard.report.rs-pdf', [
            'datas' => $datas,
            'month' => $month
        ]);
        
    	return $pdf->download('Laporan RS');
    }

    public function penggunaPdf(Request $request)
    {
        
        $datas = Pendonor::whereMonth('created_at', $request->month)->get();
    
        $month = Carbon::createFromFormat('m', $request->month)->monthName;

        $pdf = PDF::loadview('dashboard.report.pengguna-pdf', [
            'datas' => $datas,
            'month' => $month
        ]);
        
    	return $pdf->download('Laporan Pengguna');
    }
}
