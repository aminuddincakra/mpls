<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class KelasCriteria.
 *
 * @package namespace App\Criteria;
 */
class KelasCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if(\Auth::user()->perm_id == '2' OR \Auth::user()->perm_id == '1'){
            $model = $model->where('user_id',\Auth::user()->id);
        }

        return $model;
    }
}
