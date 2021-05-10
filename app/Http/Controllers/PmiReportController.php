<?php

namespace App\Http\Controllers;

use App\Models\{Pendonor, Pengajuan, Permintaan};
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PmiReportController extends Controller
{
    public $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
                        'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    public $years = ['2017','2018','2019', '2020', '2021', '2022', '2023'];

    // public function rs()
    // {
    //     $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
    //     'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    //     $datas = Permintaan::all();

    //     return view('dashboard.report.rs',[
    //         'datas' => $datas,
    //         'months' => $months,
    //         'numberMonth' => 0
    //     ]);
    // }

    public function rs()
    {
        $users = User::where('role', 'rs')->get();
        return view('dashboard.report.rs.index', [
            'users' => $users
        ]);
    }

    public function detail_rs($id)
    {
        $user = User::find($id);
        return view('dashboard.report.rs.detail', [
            'user' => $user
        ]);
    }

    public function pdf_rs($id)
    {
        $user = User::find($id);
        $pdf = PDF::loadview('dashboard.report.rs.pdf', [
            'user' => $user,
        ]);
    	return $pdf->download('Laporan '.$user->nama_rs. '.pdf');
    }

    public function pengguna()
    {
        $datas = Pendonor::all();
        $places = Pengajuan::all();

        return view('dashboard.report.pengguna', [
            'datas' => $datas,
            'months' => $this->months,
            'numberMonth' => 0,
            'years' => $this->years,
            'yearSelected' => now()->year(),
            'places' => $places
        ]);
    }

    public function penggunaSearch(Request $request)
    {

        $datas = Pendonor::whereMonth('created_at', $request->month)->get();
        $places = Pengajuan::all();

        return view('dashboard.report.pengguna', [
            'months' => $this->months,
            'years' => $this->years,
            'yearSelected' => $request->year,
            'places' => $places,
            'datas' => $datas,
            'numberMonth' => $request->month,
        ]);

    }

    public function rsSearch(Request $request)
    {
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juni',
        'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $years = ['2017','2018','2019', '2020', '2021', '2022', '2023'];

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
