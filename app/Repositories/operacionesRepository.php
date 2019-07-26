<?php

namespace App\Repositories;

use App\Models\operaciones;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class operacionesRepository
 * @package App\Repositories
 * @version July 26, 2019, 10:56 am CDT
 *
 * @method operaciones findWithoutFail($id, $columns = ['*'])
 * @method operaciones find($id, $columns = ['*'])
 * @method operaciones first($columns = ['*'])
*/
class operacionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'monto',
        'empresa_id',
        'cuenta_id',
        'proveedor_id',
        'numfactura',
        'clasifica_id',
        'tipo',
        'metpago',
        'concepto',
        'comentario',
        'fecha'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return operaciones::class;
    }
}
