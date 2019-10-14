<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\Mail;


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
         //$schedule->command('inspire')
        //          ->everyMinute();
        $schedule->call(function () {
          $tareasvencidas = \App\Models\tareas::where('avance_porc','<','100')
                            ->whereNull('terminado')
                            ->where('vencimiento', '<', date('Y-m-d') )
                            ->get();
          foreach($tareasvencidas as $tarea){
            Mail::to($tarea->user->email)->send(new \App\Mail\TareasVencidas($tarea));
          }
        })
        //->dailyAt('07:00')
        ->everyFiveMinutes()
        ->appendOutputTo(storage_path('logs/notificatareasvencidas.log'));
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
