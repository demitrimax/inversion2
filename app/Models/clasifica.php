<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class clasifica
 * @package App\Models
 * @version May 31, 2019, 12:26 am CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nombre
 * @property string descripcion
 */
class clasifica extends Model
{
    use SoftDeletes;

    public $table = 'cat_clasifica';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required'
    ];

    
}
