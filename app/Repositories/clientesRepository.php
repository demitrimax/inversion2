<?php

namespace App\Repositories;

use App\Models\clientes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class clientesRepository
 * @package App\Repositories
 * @version August 8, 2019, 10:59 am CDT
 *
 * @method clientes findWithoutFail($id, $columns = ['*'])
 * @method clientes find($id, $columns = ['*'])
 * @method clientes first($columns = ['*'])
*/
class clientesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'RFC',
        'comentario',
        'direccion',
        'telefono',
        'correo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return clientes::class;
    }
}
