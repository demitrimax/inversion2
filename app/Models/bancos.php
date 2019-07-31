<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class bancos
 * @package App\Models
 * @version June 3, 2019, 10:41 am CDT
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string nombre
 * @property string denominacionsocial
 * @property string nombrecorto
 * @property string RFC
 * @property string Entidad
 * @property string grupofinancierto
 * @property string paginainternet
 * @property string logo
 * @property string email
 */
class bancos extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $table = 'cat_bancos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];


    public $fillable = [
        'nombre',
        'denominacionsocial',
        'nombrecorto',
        'RFC',
        'Entidad',
        'grupofinancierto',
        'paginainternet',
        'logo',
        'email',
        'ejecutivo',
        'telefono',
        'extension'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                  => 'integer',
        'nombre'              => 'string',
        'denominacionsocial'  => 'string',
        'nombrecorto'         => 'string',
        'RFC'                 => 'string',
        'Entidad'             => 'string',
        'grupofinancierto'    => 'string',
        'paginainternet'      => 'string',
        'logo'                => 'string',
        'email'               => 'string',
        'ejecutivo'           => 'string',
        'telefono'            => 'string',
        'extension'           => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'denominacionsocial' => 'required',
        'nombrecorto' => 'required',
        'RFC' => 'required'
    ];

    public function cuentas()
    {
      return $this->hasMany('App\Models\bcuentas', 'banco_id');
    }


}
