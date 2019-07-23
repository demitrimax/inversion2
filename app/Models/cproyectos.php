<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class cproyectos
 * @package App\Models
 * @version May 27, 2019, 11:58 am CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 * @property string descripcion
 * @property string finicio
 * @property integer clasificacion
 */
class cproyectos extends Model
{
    use SoftDeletes;

    public $table = 'cat_proyectos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'descripcion',
        'finicio',
        'clasificacion'
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
        'finicio' => 'date',
        'clasificacion' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required'
    ];

    public function clasifica()
    {
      return $this->belongsTo('App\Models\clasifica', 'clasificacion');
    }

    public function getFolioAttribute()
    {
      $formatFolio = '#'.$this->created_at->format('y').$this->created_at->format('m').str_pad($this->id,4,"0",STR_PAD_LEFT);
      return $formatFolio;
    }


}
