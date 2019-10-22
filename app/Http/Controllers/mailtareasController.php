<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailtareasController extends Controller
{
    //

    public function tareasVencidas()
    {
      $tareasvencidas = \App\Models\tareas::where('avance_porc','<','100')
                        ->whereNull('terminado')
                        ->where('vencimiento', '<', date('Y-m-d') )
                        ->where('vencimientomail_at','<', date('Y-m-d'))
                        ->get();
        //dd($tareasvencidas);
      foreach($tareasvencidas as $tarea){
        Mail::to($tarea->user->email)->send(new \App\Mail\TareasVencidas($tarea));
        $tarea->vencimientomail_at = date('Y-m-d');
        $tarea->save();
      }
      //return 'Tareas enviadas';
    }
}
