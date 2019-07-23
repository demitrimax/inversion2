<?php

namespace App\Repositories;

use App\Models\bancos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bancosRepository
 * @package App\Repositories
 * @version June 3, 2019, 10:41 am CDT
 *
 * @method bancos findWithoutFail($id, $columns = ['*'])
 * @method bancos find($id, $columns = ['*'])
 * @method bancos first($columns = ['*'])
*/
class bancosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'denominacionsocial',
        'nombrecorto',
        'RFC',
        'Entidad',
        'grupofinancierto',
        'paginainternet',
        'logo',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bancos::class;
    }
}
