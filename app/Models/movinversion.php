<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class movinversion extends Model
{
    //
    use SoftDeletes;

    public $table = 'mov_inversion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'cuenta_id',
        'proyecto_id',
        'user_id',
        'monto',
        'tinteres',
        'fecha',
        'metpago',
        'observaciones',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'cuenta_id'     => 'integer',
        'proyecto_id'   => 'integer',
        'user_id'       => 'integer',
        'monto'         => 'float',
        'tinteres'      => 'float',
        'fecha'         => 'date',
        'metpago'       => 'integer',
        'observaciones' => 'string',
    ];

    public function proyecto()
    {
      return $this->BelongsTo('App\Models\cproyectos','proyecto_id');
    }
    public function cuenta()
    {
      return $this->BelongsTo('App\Models\bcuentas','cuenta_id');
    }

}
