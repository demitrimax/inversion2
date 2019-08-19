<?php

namespace App\Repositories;

use App\Models\facturara;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class facturaraRepository
 * @package App\Repositories
 * @version August 19, 2019, 10:04 am CDT
 *
 * @method facturara findWithoutFail($id, $columns = ['*'])
 * @method facturara find($id, $columns = ['*'])
 * @method facturara first($columns = ['*'])
*/
class facturaraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'rfc',
        'direccion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return facturara::class;
    }
}
