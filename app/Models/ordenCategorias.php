<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ordenCategorias extends Model
{
    //
    use LogsActivity;

    public $table = 'orden_categorias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected static $logAttributes = ['*'];


    public $fillable = [
        'empresa_id',
        'categoria_id',
        'orden',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'empresa_id'    => 'integer',
        'categoria_id'  => 'integer',
        'orden'         => 'integer'

    ];

}
