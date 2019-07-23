<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\creditos;
use App\Models\movinversion;

/**
 * Class bcuentas
 * @package App\Models
 * @version June 17, 2019, 9:48 am CDT
 *
 * @property \App\Models\CatBanco banco
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer banco_id
 * @property string numcuenta
 * @property string clabeinterbancaria
 * @property string sucursal
 * @property integer cliente_id
 * @property integer empresa_id
 * @property string swift
 */
class bcuentas extends Model
{
    use SoftDeletes;

    public $table = 'catcuentas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'banco_id',
        'numcuenta',
        'clabeinterbancaria',
        'sucursal',
        'cliente_id',
        'divisa',
        'swift'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'banco_id'           => 'integer',
        'numcuenta'          => 'string',
        'clabeinterbancaria' => 'string',
        'sucursal'           => 'string',
        'cliente_id'         => 'integer',
        'divisa'             => 'string',
        'swift'              => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'banco_id' => 'required',
        'numcuenta' => 'required',
        'divisa'    => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function banco()
    {
        return $this->belongsTo(\App\Models\bancos::class, 'banco_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function empresa()
    {
      return $this->belongsToMany('App\Models\empresas', 'catempresas_catcuentas');
    }
    public function operaciones()
    {
      return $this->hasMany('App\Models\operaciones', 'cuenta_id');
    }
    public function getNomcuentaAttribute()
    {
      return $this->banco->nombrecorto.'-'.$this->numcuenta;
    }
    public function movcreditos()
    {
      return $this->hasMany('App\Models\movcreditos','cuenta_id');
    }
    public function inversiones()
    {
      return $this->hasMany('App\Models\movinversion', 'cuenta_id');
    }
    public function creditos()
    {
      return $this->hasMany('App\Models\creditos', 'cuenta_id');
    }
    public function getSaldocuentaAttribute()
    {
      //saldo de creditos
      $creditos = $this->creditos->sum('monto_inicial');

      $inversion = $this->inversiones->sum('monto');

      $abonos = $this->movcreditos->where('tipo','Entrada')->sum('monto');
      $cargos = $this->movcreditos->where('tipo','Salida')->sum('monto');

      $opcargos = $this->operaciones->where('tipo', 'Salida')->sum('monto');
      $opabonos = $this->operaciones->where('tipo', 'Entrada')->sum('monto');
      $saloperaciones = $opabonos - $opcargos;

      return $creditos - $inversion - (($cargos-$abonos) - $saloperaciones);
    }
    public function getNomcuentasaldoAttribute()
    {
      return $this->banco->nombrecorto.'-'.$this->numcuenta.'($'.number_format($this->saldocuenta,2).')'.$this->divisa;
    }
}
