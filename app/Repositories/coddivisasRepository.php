<?php

namespace App\Repositories;

use App\Models\coddivisas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class coddivisasRepository
 * @package App\Repositories
 * @version July 9, 2019, 1:49 pm CDT
 *
 * @method coddivisas findWithoutFail($id, $columns = ['*'])
 * @method coddivisas find($id, $columns = ['*'])
 * @method coddivisas first($columns = ['*'])
*/
class coddivisasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return coddivisas::class;
    }
}
