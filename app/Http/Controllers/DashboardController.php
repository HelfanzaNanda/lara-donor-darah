<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockDarah;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        $data['goldar'] = StockDarah::orderBy('gol_dar','ASC')->get();
        // $data['a_plus'] = StockDarah::where('gol_dar', 'A')->where('rhesus','+')->get();
        // $data['a_minus'] = StockDarah::where('gol_dar', 'A')->where('rhesus','-')->get();
        // $data['b_plus'] = StockDarah::where('gol_dar', 'B')->where('rhesus','+')->get();
        // $data['b_minus'] = StockDarah::where('gol_dar', 'B')->where('rhesus','-')->get();
        // $data['ab_plus'] = StockDarah::where('gol_dar', 'AB')->where('rhesus','+')->get();
        // $data['ab_minus'] = StockDarah::where('gol_dar', 'AB')->where('rhesus','-')->get();
        // $data['o_plus'] = StockDarah::where('gol_dar', 'O')->where('rhesus','+')->get();
        // $data['o_minus'] = StockDarah::where('gol_dar', 'O')->where('rhesus','-')->get();
        return view('dashboard.dashboard',$data);
    }
}
