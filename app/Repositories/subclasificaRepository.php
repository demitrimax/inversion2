<?php

namespace App\Repositories;

use App\Models\subclasifica;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class subclasificaRepository
 * @package App\Repositories
 * @version July 26, 2019, 12:27 pm CDT
 *
 * @method subclasifica findWithoutFail($id, $columns = ['*'])
 * @method subclasifica find($id, $columns = ['*'])
 * @method subclasifica first($columns = ['*'])
*/
class subclasificaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
        'clasifica_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return subclasifica::class;
    }
}
