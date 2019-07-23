<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class corridafinanciera extends Model
{
    //
    use SoftDeletes;
    use LogsActivity;

    public $table = 'corridafinanciera';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];

    public $fillable = [
        'credito_id',
        'numpago',
        'anio',
        'sdocapital',
    ];

    protected $casts = [
        'credito_id' => 'integer',
        'numpago'=> 'integer',
        'anio' => 'integer',
        'sdocapital' => 'float',
        'pagcapital' => 'float',
        'pintereses' => 'float',
        'mpago'=> 'float',
        'saldocapital'=> 'float',
        'fecha' => 'date',
    ];
    public function getPagoyfechaAttribute()
    {
      return '$'.number_format($this->mpago,2).'('.$this->fecha->format('d-m-Y').')';
    }
}
