<?php

namespace App\Repositories;

use App\Models\bcuentas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bcuentasRepository
 * @package App\Repositories
 * @version June 17, 2019, 9:48 am CDT
 *
 * @method bcuentas findWithoutFail($id, $columns = ['*'])
 * @method bcuentas find($id, $columns = ['*'])
 * @method bcuentas first($columns = ['*'])
*/
class bcuentasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'banco_id',
        'numcuenta',
        'clabeinterbancaria',
        'sucursal',
        'cliente_id',
        'empresa_id',
        'swift'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bcuentas::class;
    }
}
