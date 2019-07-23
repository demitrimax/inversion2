<?php

namespace App\Repositories;

use App\Models\efinanciera;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class efinancieraRepository
 * @package App\Repositories
 * @version May 27, 2019, 10:31 am CDT
 *
 * @method efinanciera findWithoutFail($id, $columns = ['*'])
 * @method efinanciera find($id, $columns = ['*'])
 * @method efinanciera first($columns = ['*'])
*/
class efinancieraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'contacto',
        'telefono'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return efinanciera::class;
    }
}
