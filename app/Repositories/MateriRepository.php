<?php

namespace App\Repositories;

use App\Models\Materi;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MateriRepository
 * @package App\Repositories
 * @version July 10, 2021, 9:06 am WIB
 *
 * @method Materi findWithoutFail($id, $columns = ['*'])
 * @method Materi find($id, $columns = ['*'])
 * @method Materi first($columns = ['*'])
*/
class MateriRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'date'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Materi::class;
    }
}
