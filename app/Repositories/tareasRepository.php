<?php

namespace App\Repositories;

use App\Models\tareas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class tareasRepository
 * @package App\Repositories
 * @version August 2, 2019, 11:42 am CDT
 *
 * @method tareas findWithoutFail($id, $columns = ['*'])
 * @method tareas find($id, $columns = ['*'])
 * @method tareas first($columns = ['*'])
*/
class tareasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'vencimiento',
        'user_id',
        'viewed_at',
        'terminado',
        'avance_porc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return tareas::class;
    }
}
