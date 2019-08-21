<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class invoperacion
 * @package App\Models
 * @version August 8, 2019, 12:30 pm CDT
 *
 * @property \App\Models\User usuario
 * @property \App\Models\CatProveedore proveedor
 * @property \App\Models\CatEmpresa cliente
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection invDetoperacions
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer usuario_id
 * @property string tipo_mov
 * @property integer proveedor_id
 * @property integer cliente_id
 * @property float monto
 * @property string fecha
 * @property boolean cancelada
 */
class invoperacion extends Model
{
    use SoftDeletes;

    public $table = 'inv_operacion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'usuario_id',
        'tipo_mov',
        'facturara_id',
        'proveedor_id',
        'cliente_id',
        'monto',
        'fecha',
        'cancelada'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'usuario_id'    => 'integer',
        'facturara_id'  => 'integer',
        'tipo_mov'      => 'string',
        'proveedor_id'  => 'integer',
        'cliente_id'    => 'integer',
        'monto'         => 'float',
        'fecha'         => 'date',
        'cancelada'     => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'usuario_id'    => 'required',
        'tipo_mov'      => 'required',
        'fecha'         => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(\App\User::class, 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proveedor()
    {
        return $this->belongsTo(\App\Models\invproveedores::class, 'proveedor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cliente()
    {
        return $this->belongsTo(\App\Models\clientes::class, 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function invdetoperacions()
    {
        return $this->hasMany('App\Models\invdetoperacion','operacion_id');
    }
    public function facturara()
    {
      return $this->belongsTo('App\Models\facturara', 'facturara_id');
    }
    public function getPersonanombreAttribute()
    {
      $personanombre = 'N/D';
      if($this->proveedor_id){
        $personanombre = 'Proveedor: '.$this->proveedor->nombre;
      }
      elseif ($this->cliente_id){
        $personanombre = 'Cliente: '.$this->cliente->nombre;
      }
      return $personanombre;
    }
    public function getEstatusgAttribute()
    {
      $estatus = 'n/d';
      $this->estatus == 'S'  ? $estatus = 'Solicitud' : '';
      $this->estatus == 'T'  ? $estatus = 'Surtida Totalmente' : '';
      $this->estatus == 'P'  ? $estatus = 'Surtida Parcialmente' : '';
      $this->estatus == 'G'  ? $estatus = 'Pagada' : '';
      $this->estatus == 'F'  ? $estatus = 'Facturada' : '';
      return $estatus;
    }
    public function getEstatushAttribute()
    {
      $estado = 'N/D';
      $est = 'N';
      $label = 'primary';
      //Estado de una Entrada o Solicitud de Entrada
      if($this->tipo_mov == 'Entrada'){
        $estado = 'Solicitud';
        $est = 'S';
        $label = 'primary';

        $diferentes = $this->invdetoperacions->unique('estatus')->pluck('estatus');
        $diferentes = $diferentes->toArray();
        //dd($diferentes);

        if( in_array('S', $diferentes) && in_array('P', $diferentes) && in_array('T', $diferentes) ){
          $estado = 'Surtido Parcialmente';
          $est = 'S';
          $label = 'warning';
        }
        elseif( in_array('S', $diferentes) && in_array('P', $diferentes) ){
          $estado = 'Surtido Parcialmente';
          $est = 'P';
          $label = 'warning';
        }
        elseif( in_array('S', $diferentes) && in_array('T', $diferentes) ){

          $estado = 'Surtido Parcialmente';
          $est = 'P';
          $label = 'warning';
        }
        elseif( in_array('P', $diferentes) && in_array('T', $diferentes) ){
          $estado = 'Surtido Parcialmente';
          $est = 'P';
          $label = 'warning';
        }
        elseif( in_array('S', $diferentes)){
          $estado = 'Solicitud';
          $est = 'S';
          $label = 'primary';
        }
        elseif( in_array('P', $diferentes)){
          $estado = 'Surtido Parcialmente';
          $est = 'P';
          $label = 'warning';
        }
        elseif( in_array('T', $diferentes)){
          $estado = 'Surtido en Totalidad';
          $est = 'T';
          $label = 'success';
        }

      }
      elseif($this->tipo_mov == 'Salida'){
        $estado = 'Facturada';
        $est = 'F';
        $label = 'primary';
      }
      //return $estatusoperaciones;
      $salida = ['estado' => $estado, 'letra' => $est, 'label'=>$label ];
      return $salida;
    }

    public function getFolioAttribute()
    {
      $formatFolio = '#'.$this->created_at->format('y').$this->created_at->format('m').str_pad($this->id,4,"0",STR_PAD_LEFT);
      return $formatFolio;
    }

}
