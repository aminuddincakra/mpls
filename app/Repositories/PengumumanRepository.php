<?php

namespace App\Repositories;

use App\Models\Pengumuman;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PengumumanRepository
 * @package App\Repositories
 * @version July 10, 2021, 4:24 am WIB
 *
 * @method Pengumuman findWithoutFail($id, $columns = ['*'])
 * @method Pengumuman find($id, $columns = ['*'])
 * @method Pengumuman first($columns = ['*'])
*/
class PengumumanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pengumuman::class;
    }
}
