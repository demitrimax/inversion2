<?php

namespace App\Repositories;

use App\Models\invproveedores;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class invproveedoresRepository
 * @package App\Repositories
 * @version August 13, 2019, 11:34 am CDT
 *
 * @method invproveedores findWithoutFail($id, $columns = ['*'])
 * @method invproveedores find($id, $columns = ['*'])
 * @method invproveedores first($columns = ['*'])
*/
class invproveedoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'rfc',
        'domicilio',
        'telefono',
        'contacto',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return invproveedores::class;
    }
}
