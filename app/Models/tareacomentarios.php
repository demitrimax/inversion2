<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class tareacomentarios extends Model
{
    //
    use SoftDeletes;
    use LogsActivity;

    public $table = 'tareascomentarios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];

    public $fillable = [
        'user_id',
        'avance_id',
        'tarea_id',
        'comentario',
    ];

    public function usuario()
    {
      return $this->belongsTo('App\User', 'user_id');
    }
    public function avance()
    {
      return $this->belongsTo('App\Models\tareavances', 'avance_id');
    }
    public function tarea()
    {
      return $this->belongsTo('App\Models\tareas', 'tarea_id');
    }

}
