<?php

namespace App\Repositories;

use App\Models\empresas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class empresasRepository
 * @package App\Repositories
 * @version June 9, 2019, 8:20 am CDT
 *
 * @method empresas findWithoutFail($id, $columns = ['*'])
 * @method empresas find($id, $columns = ['*'])
 * @method empresas first($columns = ['*'])
*/
class empresasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'giro',
        'fcreacion',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return empresas::class;
    }
}
