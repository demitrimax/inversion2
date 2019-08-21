<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invdetoperacion extends Model
{
    //
    use SoftDeletes;

    public $table = 'inv_detoperacion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'operacion_id',
        'producto_id',
        'cantidad',
        'punitario',
        'importe',
        'tipo_operacion',
        'fecha',
        'bodega_id'
    ];
    protected $casts = [
        'id'              =>  'integer',
        'operacion_id'    => 'integer',
        'producto_id'     => 'integer',
        'cantidad'        => 'integer',
        'punitario'       => 'float',
        'importe'         => 'float',
        'tipo_operacion'  => 'string',
        'fecha'           => 'date',
        'bodega_id'       => 'integer'

    ];

    public function producto()
    {
      return $this->belongsTo('App\Models\productos', 'producto_id');
    }

    public function getEstatushAttribute()
    {
      $estado = 'Solicitud de Salida';
      $est = 'S';
      $label = 'success';

      if($this->tipo_operacion == 'Entrada'){
        if($this->estatus == 'S'){
          $estado = 'Solicitud';
          $est = 'S';
          $label = 'primary';
        }
        if($this->estatus == 'T'){
          $estado = 'Surtido Totalmente';
          $est = 'T';
          $label = 'success';
        }
        if($this->estatus == 'P'){
          $estado = 'Surtido Parcialmente';
          $est = 'P';
          $label = 'warning';
        }

      }
        elseif($this->tipo_operacion == 'Salida')
        {
          if($this->estatus == 'S'){
            $estado = 'Solicitud';
            $est = 'S';
            $label = 'primary';
          }
        }

      $salida = ['estado' => $estado, 'letra' => $est, 'label'=>$label ];
      return $salida;
    }

}
