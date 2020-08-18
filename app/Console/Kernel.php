<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use DB;
use App\Models\Jadwal;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $dateNow = Carbon::now()->format('y/m/d');
        // $jadwal = Jadwal::all();
        // foreach($jadwal as $j){
        //     $dateDone = 
        // }
        // $schedule->call(function () {
        //     DB::table('jadwal')->where('jadwal',)->update(['status' => 'selesai']);
        // })->daily();
        // $startDate = Carbon::createFromFormat('y/m/d');
        // $endDate = Carbon::createFromFormat('y/m/d');

        // $check = Carbon::now()->format('y/m/d')->between($startDate,$endDate);
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
