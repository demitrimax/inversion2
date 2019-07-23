<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class proveedores
 * @package App\Models
 * @version July 2, 2019, 11:18 pm CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 * @property string rfc
 * @property string domicilio
 * @property string telefono
 * @property string contacto
 */
class proveedores extends Model
{
    use SoftDeletes;

    public $table = 'cat_proveedores';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'rfc',
        'domicilio',
        'telefono',
        'contacto',
        'observaciones'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'nombre'        => 'string',
        'rfc'           => 'string',
        'domicilio'     => 'string',
        'telefono'      => 'string',
        'contacto'      => 'string',
        'observaciones' => 'string',
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
