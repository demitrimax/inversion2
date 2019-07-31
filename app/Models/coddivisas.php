<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class coddivisas
 * @package App\Models
 * @version July 9, 2019, 1:49 pm CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 */
class coddivisas extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $table = 'cod_divisas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $primary = 'codigo';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];


    public $fillable = [
        'codigo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required'
    ];

    public function cuentas()
    {
      return $this->hasMany('App\Models\bcuentas', 'divisa');
    }


}
