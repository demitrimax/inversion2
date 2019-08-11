<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invdetoperacion extends Model
{
    //
    use SoftDeletes;

    public $table = 'inv_detoperacion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'operacion_id',
        'producto_id',
        'cantidad',
        'punitario',
        'importe',
        'tipo_operacion',
        'fecha'
    ];

}
