<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class facturas
 * @package App\Models
 * @version August 1, 2019, 1:13 pm CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string numfactura
 * @property float monto
 * @property string concepto
 * @property string observaciones
 */
class facturas extends Model
{
    use SoftDeletes;

    public $table = 'cat_facturas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'numfactura',
        'monto',
        'fecha',
        'concepto',
        'observaciones',
        'operacion_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            =>  'integer',
        'numfactura'    => 'string',
        'monto'         => 'float',
        'fecha'         => 'date',
        'concepto'      => 'string',
        'observaciones' => 'string',
        'operacion_id'  => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numfactura'    => 'required',
        'monto'         => 'required',
        'concepto'      => 'required'
    ];

    public function operacion()
    {
      return $this->belongsTo('App\Models\operacion', 'operacion_id');
    }

}
