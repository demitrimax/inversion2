<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class creditos
 * @package App\Models
 * @version May 25, 2019, 3:27 pm CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 * @property string numero
 * @property string finicio
 * @property string ftermino
 * @property float tasainteres
 * @property integer entidadfinan
 * @property string diapago
 * @property float monto_inicial
 * @property string fapertura
 * @property integer diascalculo
 */
class creditos extends Model
{
    use SoftDeletes;

    public $table = 'creditos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'numero',
        'empresa_id',
        'cuenta_id',
        'finicio',
        'ftermino',
        'tasainteres',
        'diapago',
        'monto_inicial',
        'fapertura',
        'diascalculo',
        'meseslibres',
        'observaciones',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'nombre'          => 'string',
        'empresa_id'      => 'integer',
        'cuenta_id'       => 'integer',
        'numero'          => 'string',
        'finicio'         => 'date',
        'ftermino'        => 'date',
        'tasainteres'     => 'float',
        'diapago'         => 'integer',
        'monto_inicial'   => 'float',
        'fapertura'       => 'date',
        'diascalculo'     => 'integer',
        'meseslibres'     => 'integer',
        'observaciones'   => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tasainteres'     => 'required',
        'empresa_id'      => 'required',
        'cuenta_id'       => 'required',
        'monto_inicial'   => 'required',
    ];

    public function financieras()
    {
      return $this->belongsTo('App\Models\efinanciera', 'entidadfinan');
    }

    public function movcreditos()
    {
      return $this->hasMany('App\Models\movcreditos','credito_id');
    }
    public function cuenta()
    {
      return $this->belongsTo('App\Models\bcuentas', 'cuenta_id');
    }
    public function corridas()
    {
      return $this->hasMany('App\Models\corridafinanciera', 'credito_id');
    }
    public function empresa()
    {
      return $this->belongsTo('App\Models\empresas', 'empresa_id');
    }
    public function getMontorestanteAttribute()
    {
      $tSalidas = 0;
      $tEntradas = 0;
      $monto = $this->monto_inicial;
      foreach($this->movcreditos as $movimiento)
      {
        $movimiento->tipo == 'Salida' ? $tSalidas += $movimiento->monto : 0;
        //$movimiento->tipo == 'Entrada'? $tEntradas += $movimiento->monto : 0;
      }
      $saldofinal = $monto - ($tSalidas);
      return $saldofinal;
    }


}
