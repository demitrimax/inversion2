<?php

namespace App\Repositories;

use App\Models\invoperacion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class invoperacionRepository
 * @package App\Repositories
 * @version August 8, 2019, 12:30 pm CDT
 *
 * @method invoperacion findWithoutFail($id, $columns = ['*'])
 * @method invoperacion find($id, $columns = ['*'])
 * @method invoperacion first($columns = ['*'])
*/
class invoperacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'usuario_id',
        'tipo_mov',
        'proveedor_id',
        'cliente_id',
        'monto',
        'fecha',
        'cancelada'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return invoperacion::class;
    }
}
