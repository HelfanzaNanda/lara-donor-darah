<?php

namespace App\Http\Controllers;

use App\Models\Pendonor;
use App\Models\Pengajuan;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use App\Models\StockDarah;
use App\User;
use Carbon\Carbon;

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

    public function chartRs()
    {

        $hospitals = User::where('role', 'rs')->get();

        
        $data = [];
        foreach($hospitals as $hospital){
            $name = $hospital->nama_rs;
            $total = [0, count($hospital->permintaans)];
            $item = [
                "x" => $name,
                "y" => $total
            ];
            array_push($data, $item);
        }

        $result[] = [
            "data" => $data
        ];

        return json_encode($result);

    }

            // series: [{
            //     data: [{
            //         x: 'Team A',
            //         y: [0, 5]
            //     }, {
            //         x: 'Team B',
            //         y: [4, 6]
            //     }, {
            //         x: 'Team C',
            //         y: [5, 8]
            //     }, {
            //         x: 'Team D',
            //         y: [3, 11]
            //     }]
            // }],

    public function chartPendonor()
    {
        $users = User::where('role', 'pendonor')->get();
        $data = [];

        foreach ($users as $user) {
            $name = $user->nama;
            $total = [0, count($user->pendonors)];
            $item = [
                "x" => $name,
                "y" => $total
            ];
            array_push($data, $item);
        }

        $series[] = ["data" => $data];

        return json_encode($series);
    }

    public function chartTempat()
    {
        $places = Pengajuan::where('status', 'diterima')->get();
        //$places = Pengajuan::all();

        $data = [];

        foreach($places as $key => $place) {
            $name = ucwords(strtolower($place->nama_tempat));
            $filter = array_filter($data, function ($var) use ($name) {
                return ($var['x'] == $name);
            });
            //$filter = array_filter($name, array_column($data, 'x'));
            if ($filter) {
                
                //isset($data[$key]["y"]) ? $data[$key+1]["y"] += 1 : 0;
                $data[$key-1]["y"][1] += 1;
            }else{
                $item = [
                    "x" => $name,
                    "y" => [0, 1]
                ];
                array_push($data, $item);
            }
        }

        $series[] = ["data" => $data];

        return json_encode($series);
    }

    public function chartDarah()
    {
        // series: [{
        //     name: 'series1',
        //     data: [31, 40, 28, 51, 42, 109, 100]
        // }, {
        //     name: 'series2',
        //     data: [11, 32, 45, 32, 34, 52, 41]
        // }],


        $stoks = StockDarah::all();


        $series = [];
        foreach($stoks as $key => $stok){
            $name = $stok->gol_dar;
            $data = [];
            for ($i=1; $i<=12; $i++) { 
                $qty = StockDarah::whereMonth('created_at', $i)->get()->sum('qty');
                array_push($data, $qty);
            }
            $item = [
                "name" => $name,
                "data" => $data
            ];
            if (!in_array($item, $series)) {
                $series[] = $item;
            }

        }

        //$series = array_unique($series);

        return json_encode($series);
    }
}
