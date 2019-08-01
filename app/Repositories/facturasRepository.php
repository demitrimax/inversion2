<?php

namespace App\Repositories;

use App\Models\facturas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class facturasRepository
 * @package App\Repositories
 * @version August 1, 2019, 1:13 pm CDT
 *
 * @method facturas findWithoutFail($id, $columns = ['*'])
 * @method facturas find($id, $columns = ['*'])
 * @method facturas first($columns = ['*'])
*/
class facturasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numfactura',
        'monto',
        'concepto',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return facturas::class;
    }
}
