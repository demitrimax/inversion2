<?php

namespace App\Repositories;

use App\Models\cproyectos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class cproyectosRepository
 * @package App\Repositories
 * @version May 27, 2019, 11:58 am CDT
 *
 * @method cproyectos findWithoutFail($id, $columns = ['*'])
 * @method cproyectos find($id, $columns = ['*'])
 * @method cproyectos first($columns = ['*'])
*/
class cproyectosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'finicio',
        'clasificacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return cproyectos::class;
    }
}
