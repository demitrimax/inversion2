<?php

namespace App\Repositories;

use App\Models\proveedores;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class proveedoresRepository
 * @package App\Repositories
 * @version July 2, 2019, 11:18 pm CDT
 *
 * @method proveedores findWithoutFail($id, $columns = ['*'])
 * @method proveedores find($id, $columns = ['*'])
 * @method proveedores first($columns = ['*'])
*/
class proveedoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'rfc',
        'domicilio',
        'telefono',
        'contacto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return proveedores::class;
    }
}
