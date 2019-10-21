<?php

namespace App\Repositories;

use App\Models\minventario;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class minventarioRepository
 * @package App\Repositories
 * @version October 21, 2019, 10:06 am CDT
 *
 * @method minventario findWithoutFail($id, $columns = ['*'])
 * @method minventario find($id, $columns = ['*'])
 * @method minventario first($columns = ['*'])
*/
class minventarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'concepto',
        'descripcion',
        'marca',
        'codigo',
        'montocompra',
        'resguardoa',
        'fileresguardo',
        'operacion_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return minventario::class;
    }
}
