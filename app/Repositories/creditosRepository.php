<?php

namespace App\Repositories;

use App\Models\creditos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class creditosRepository
 * @package App\Repositories
 * @version May 25, 2019, 3:27 pm CDT
 *
 * @method creditos findWithoutFail($id, $columns = ['*'])
 * @method creditos find($id, $columns = ['*'])
 * @method creditos first($columns = ['*'])
*/
class creditosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'numero',
        'finicio',
        'ftermino',
        'tasainteres',
        'entidadfinan',
        'diapago',
        'monto_inicial',
        'fapertura',
        'diascalculo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return creditos::class;
    }
}
