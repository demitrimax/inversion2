<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class minventario
 * @package App\Models
 * @version October 21, 2019, 10:06 am CDT
 *
 * @property \App\Models\Operacione operacion
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string concepto
 * @property string descripcion
 * @property string marca
 * @property string codigo
 * @property float montocompra
 * @property string resguardoa
 * @property string fileresguardo
 * @property integer operacion_id
 */
class minventario extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $table = 'minventario';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];


    public $fillable = [
        'concepto',
        'descripcion',
        'marca',
        'codigo',
        'montocompra',
        'resguardoa',
        'fileresguardo',
        'operacion_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'concepto' => 'string',
        'descripcion' => 'string',
        'marca' => 'string',
        'codigo' => 'string',
        'montocompra' => 'float',
        'resguardoa' => 'string',
        'fileresguardo' => 'string',
        'operacion_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'concepto' => 'required',
        'montocompra' => 'required',
        'operacion_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function operacion()
    {
        return $this->belongsTo(\App\Models\Operacione::class, 'operacion_id');
    }
}
