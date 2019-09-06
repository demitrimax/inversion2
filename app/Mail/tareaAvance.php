<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\tareas;

class tareaAvance extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $tarea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(tareas $tarea)
    {
        //
        $this->tarea = $tarea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Avance de Tarea')
                    ->markdown('emails.tareas.avances');
    }
}
