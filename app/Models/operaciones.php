<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class operaciones
 * @package App\Models
 * @version July 26, 2019, 10:56 am CDT
 *
 * @property \App\Models\CatEmpresa empresa
 * @property \App\Models\Catcuenta cuenta
 * @property \App\Models\CatMetpago metpago
 * @property \App\Models\CatProveedore proveedor
 * @property \App\Models\CatClasifica clasifica
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property float monto
 * @property integer empresa_id
 * @property integer cuenta_id
 * @property integer proveedor_id
 * @property string numfactura
 * @property integer clasifica_id
 * @property string tipo
 * @property integer metpago
 * @property string concepto
 * @property string comentario
 * @property string fecha
 */
class operaciones extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $table = 'operaciones';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];


    public $fillable = [
        'monto',
        'empresa_id',
        'cuenta_id',
        'proveedor_id',
        'numfactura',
        'subclasifica_id',
        'tipo',
        'metpago',
        'concepto',
        'comentario',
        'fecha'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'monto'           => 'float',
        'empresa_id'      => 'integer',
        'cuenta_id'       => 'integer',
        'proveedor_id'    => 'integer',
        'numfactura'      => 'string',
        'subclasifica_id' => 'integer',
        'tipo'            => 'string',
        'metpago'         => 'integer',
        'concepto'        => 'string',
        'comentario'      => 'string',
        'fecha'           => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'monto'             => 'required',
        'empresa_id'        => 'required',
        'cuenta_id'         => 'required',
        'proveedor_id'      => 'required',
        'subclasifica_id'   => 'required',
        'tipo'              => 'required',
        'metpago'           => 'required',
        'concepto'          => 'required',
        'fecha'             => 'required'
    ];

    public function empresa()
    {
      return $this->belongsTo('App\Models\empresas','empresa_id');
    }
    public function cuenta()
    {
        return $this->belongsTo('App\Models\bcuentas', 'cuenta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function metopago()
    {
        return $this->belongsTo(\App\Models\metpago::class, 'metpago');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proveedor()
    {
        return $this->belongsTo(\App\Models\proveedores::class, 'proveedor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function subclasifica()
    {
        return $this->belongsTo('App\Models\subclasifica', 'subclasifica_id');
    }
}
