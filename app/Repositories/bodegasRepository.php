<?php

namespace App\Repositories;

use App\Models\bodegas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bodegasRepository
 * @package App\Repositories
 * @version August 8, 2019, 10:40 am CDT
 *
 * @method bodegas findWithoutFail($id, $columns = ['*'])
 * @method bodegas find($id, $columns = ['*'])
 * @method bodegas first($columns = ['*'])
*/
class bodegasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'ubicacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bodegas::class;
    }
}
