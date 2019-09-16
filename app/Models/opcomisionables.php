<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class opcomisionables extends Model
{
    //
    use SoftDeletes;
    use LogsActivity;

    public $table = 'op_comisionables';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];

    public function Origen()
    {
      return $this->belongsTo('App\Models\operaciones', 'id_operacion');
    }
    public function Comisionada()
    {
      return $this->belongsTo('App\Models\operaciones', 'id_op_comision');
    }
}
