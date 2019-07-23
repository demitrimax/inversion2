<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class operaciones extends Model
{
    //
    use SoftDeletes;

    public $table = 'operaciones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'monto',
        'empresa_id',
        'cuenta_id',
        'tipo',
        'metpago',
        'concepto',
        'comentario',
        'fecha',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'empresa_id'    => 'integer',
        'cuenta_id'     => 'integer',
        'tipo'          => 'string',
        'metpago'       => 'string',
        'concepto'      => 'string',
        'comentario'    => 'string',
        'fecha'         => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'monto'         => 'required',
        'empresa_id'    => 'required',
        'tipo'          => 'required',
        'fecha'         => 'required',
    ];

    public function empresa()
    {
      return $this->belongsTo('App\Models\empresas','empresa_id');
    }
    public function cuenta()
    {
        return $this->belongsTo('App\Models\bcuentas', 'cuenta_id');
    }
}
