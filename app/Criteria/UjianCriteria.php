<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UjianCriteria.
 *
 * @package namespace App\Criteria;
 */
class UjianCriteria implements CriteriaInterface
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
        if(\Auth::user()->perm_id != '1'){
            $model = $model->where('user_id',\Auth::user()->id);
        }

        if(\Request::get('search') != ''){
            $model = $model->where('name','like','%'.\Request::get('search').'%');
        }

        return $model;        
    }
}
