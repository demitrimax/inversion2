<?php

namespace App\Repositories;

use App\Models\metpago;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class metpagoRepository
 * @package App\Repositories
 * @version July 1, 2019, 3:27 am CDT
 *
 * @method metpago findWithoutFail($id, $columns = ['*'])
 * @method metpago find($id, $columns = ['*'])
 * @method metpago first($columns = ['*'])
*/
class metpagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'nomcorto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return metpago::class;
    }
}
