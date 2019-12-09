<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class optraspasos extends Model
{
    //
    use SoftDeletes;
    use LogsActivity;

    public $table = 'op_traspaso';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];


    public $fillable = [
        'monto',
        'origen_cta',
        'destino_cta',
        'operacion_id',
        'concepto',
        'fecha'
    ];
    protected $casts = [
        'id'              => 'integer',
        'monto'           => 'float',
        'origen_cta'      => 'integer',
        'destino_cta'     => 'integer',
        'operacion_id'    => 'integer',
        'concepto'        => 'string',
        'fecha'           => 'date'
    ];

    public function ctaorigen()
    {
        return $this->belongsTo('App\Models\bcuentas', 'origen_cta');
    }

    public function ctadestino()
    {
        return $this->belongsTo('App\Models\bcuentas', 'destino_cta');
    }
}
