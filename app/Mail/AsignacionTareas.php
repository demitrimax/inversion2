<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\tareas;

class AsignacionTareas extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tareas;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct(tareas $tareas)
    {
        //
        $this->tareas = $tareas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mails.tareaAsignada');
    }
}
