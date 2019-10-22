<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class callEjemplo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailtareas:tareasvencidas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta la función para enviar mails de las tareas que estan vencidas...diario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->call('\App\Http\Controllers\mailtareasController@tareasVencidas');
    }
}
