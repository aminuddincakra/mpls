<?php

namespace App\Repositories;

use App\Models\Jurusan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JurusanRepository
 * @package App\Repositories
 * @version July 10, 2020, 6:50 am WIB
 *
 * @method Jurusan findWithoutFail($id, $columns = ['*'])
 * @method Jurusan find($id, $columns = ['*'])
 * @method Jurusan first($columns = ['*'])
*/
class JurusanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Jurusan::class;
    }
}
