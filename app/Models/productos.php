<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\invoperacion;

/**
 * Class productos
 * @package App\Models
 * @version August 7, 2019, 1:39 pm CDT
 *
 * @property \App\Models\Categoria categoria
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 * @property string descripcion
 * @property string imagen
 * @property string barcode
 * @property integer categoria_id
 * @property boolean inventariable
 * @property string umedida
 * @property integer stock_min
 */
class productos extends Model
{
    use SoftDeletes;

    public $table = 'cat_productos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'barcode',
        'categoria_id',
        'inventariable',
        'umedida',
        'stock_min'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'imagen' => 'string',
        'barcode' => 'string',
        'categoria_id' => 'integer',
        'inventariable' => 'boolean',
        'umedida' => 'string',
        'stock_min' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'categoria_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function categoria()
    {
        return $this->belongsTo(\App\Models\categorias::class, 'categoria_id');
    }
    public function inventarios()
    {
      return $this->hasMany('App\Models\invdetoperaciones', 'producto_id');
    }
    public function getStockAttribute()
    {
      $entradas = invdetoperacion::where('producto_id', $this->id)
                                  ->where('tipo_operacion', 'Entrada')
                                  ->sum('cantidad');
      $salidas = invdetoperacion::where('producto_id', $this->id)
                                  ->where('tipo_operacion', 'Salida')
                                  ->sum('cantidad');
      return $entradas-$salidas;
    }
}
