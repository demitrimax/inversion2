<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class invoperacion
 * @package App\Models
 * @version August 8, 2019, 12:30 pm CDT
 *
 * @property \App\Models\User usuario
 * @property \App\Models\CatProveedore proveedor
 * @property \App\Models\CatEmpresa cliente
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection invDetoperacions
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer usuario_id
 * @property string tipo_mov
 * @property integer proveedor_id
 * @property integer cliente_id
 * @property float monto
 * @property string fecha
 * @property boolean cancelada
 */
class invoperacion extends Model
{
    use SoftDeletes;

    public $table = 'inv_operacion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'usuario_id',
        'tipo_mov',
        'proveedor_id',
        'cliente_id',
        'monto',
        'fecha',
        'cancelada'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'usuario_id' => 'integer',
        'tipo_mov' => 'string',
        'proveedor_id' => 'integer',
        'cliente_id' => 'integer',
        'monto' => 'float',
        'fecha' => 'date',
        'cancelada' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'usuario_id' => 'required',
        'tipo_mov' => 'required',
        'fecha' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(\App\User::class, 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proveedor()
    {
        return $this->belongsTo(\App\Models\invproveedores::class, 'proveedor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cliente()
    {
        return $this->belongsTo(\App\Models\clientes::class, 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function invdetoperacions()
    {
        return $this->hasMany('App\Models\invdetoperacion','operacion_id');
    }
    public function getPersonanombreAttribute()
    {
      $personanombre = 'N/D';
      if($this->proveedor_id){
        $personanombre = $this->proveedor->nombre;
      }
      elseif ($this->cliente_id){
        $personanombre = $this->cliente->nombre;
      }
      return $personanombre;
    }
    public function getEstatusgAttribute()
    {
      $estatus = 'n/d';
      $this->estatus == 'S'  ? $estatus = 'Solicitud' : '';
      $this->estatus == 'T'  ? $estatus = 'Surtida en Totalidad' : '';
      $this->estatus == 'P'  ? $estatus = 'Surtida Parcialmente' : '';
      return $estatus;
    }
}
