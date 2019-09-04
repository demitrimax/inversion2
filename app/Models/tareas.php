<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon\Carbon;

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
    use LogsActivity;

    public $table = 'tareas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];


    public $fillable = [
        'nombre',
        'descripcion',
        'vencimiento',
        'user_id',
        'viewed_at',
        'terminado',
        'avance_porc',
        'asigna_userid',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'nombre'      => 'string',
        'descripcion' => 'string',
        'vencimiento' => 'date',
        'user_id'     => 'integer',
        'viewed_at'   => 'datetime',
        'terminado'   => 'datetime',
        'avance_porc' => 'integer',
        'asigna_userid' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'         => 'required',
        'asigna_userid'   => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function avances()
    {
      return $this->hasMany('App\Models\tareavances', 'tarea_id');
    }
    public function asignadopor()
    {
      return $this->belongsTo(\App\User::class, 'asigna_userid');
    }

    public function getEstatusdateAttribute()
    {
      $fechaTermino = Carbon::parse($this->vencimiento);
      $fechaActual = Carbon::parse(date('Y-m-d'));

      $diasDiferencia = $fechaActual->diffInDays($fechaTermino, false);
      $valor = "";
      $desc = "";
      if ($diasDiferencia < 0 ) {
        $valor = "danger";
        $desc = "Vencido tiene ".$diasDiferencia." días.";
      }
      if ($diasDiferencia >= 0 && $diasDiferencia < 5 ) {
        $valor = "warning";
        $desc = "Por terminar plazo, le quedan ".$diasDiferencia." días.";
      }
      if ($diasDiferencia >= 5 ) {
          $valor = "success";
          $desc = "En tiempo, le quedan ".$diasDiferencia." días.";
        }
      if ($this->avance_porc == 100){
        $valor = "info";
        $desc = "Tarea completada.";
      }

        $estatus = ['valor' => $valor, 'descripcion' => $desc ,'diferencia' => $diasDiferencia];

      return $estatus;
    }
}
