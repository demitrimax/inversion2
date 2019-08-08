<?php

namespace App\Repositories;

use App\Models\productos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class productosRepository
 * @package App\Repositories
 * @version August 7, 2019, 1:39 pm CDT
 *
 * @method productos findWithoutFail($id, $columns = ['*'])
 * @method productos find($id, $columns = ['*'])
 * @method productos first($columns = ['*'])
*/
class productosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'imagen',
        'barcode',
        'categoria_id',
        'inventariable',
        'umedida',
        'stock_min'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return productos::class;
    }
}
