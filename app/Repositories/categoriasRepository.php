<?php

namespace App\Repositories;

use App\Models\categorias;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class categoriasRepository
 * @package App\Repositories
 * @version August 6, 2019, 11:21 pm CDT
 *
 * @method categorias findWithoutFail($id, $columns = ['*'])
 * @method categorias find($id, $columns = ['*'])
 * @method categorias first($columns = ['*'])
*/
class categoriasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'imagen'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return categorias::class;
    }
}
