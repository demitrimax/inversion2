<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tareas
 * @package App\Models
 * @version August 2, 2019, 11:42 am CDT
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 * @property string descripcion
 * @property string vencimiento
 * @property integer user_id
 * @property string|\Carbon\Carbon viewed_at
 * @property string|\Carbon\Carbon terminado
 * @property integer avance_porc
 */
class tareas extends Model
{
    use SoftDeletes;

    public $table = 'tareas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'descripcion',
        'vencimiento',
        'user_id',
        'viewed_at',
        'terminado',
        'avance_porc'
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
        'vencimiento' => 'date',
        'user_id' => 'integer',
        'viewed_at' => 'datetime',
        'terminado' => 'datetime',
        'avance_porc' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
