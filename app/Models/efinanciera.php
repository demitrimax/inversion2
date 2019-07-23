<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class efinanciera
 * @package App\Models
 * @version May 27, 2019, 10:31 am CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nombre
 * @property string contacto
 * @property string telefono
 */
class efinanciera extends Model
{
    use SoftDeletes;

    public $table = 'cat_entidades';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'contacto',
        'telefono'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'contacto' => 'string',
        'telefono' => 'string'
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
