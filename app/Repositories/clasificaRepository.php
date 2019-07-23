<?php

namespace App\Repositories;

use App\Models\clasifica;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class clasificaRepository
 * @package App\Repositories
 * @version May 31, 2019, 12:26 am CDT
 *
 * @method clasifica findWithoutFail($id, $columns = ['*'])
 * @method clasifica find($id, $columns = ['*'])
 * @method clasifica first($columns = ['*'])
*/
class clasificaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return clasifica::class;
    }
}
