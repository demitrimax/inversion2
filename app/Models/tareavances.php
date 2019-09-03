<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tareavances extends Model
{
    //
    use SoftDeletes;

    public $table = 'tareavances';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'concepto',
        'comentario',
        'avancepor',
        'tarea_id'
    ];

    public function comentarios()
    {
      return $this->hasMany('App\Models\tareacomentarios', 'avance_id');
    }

}
