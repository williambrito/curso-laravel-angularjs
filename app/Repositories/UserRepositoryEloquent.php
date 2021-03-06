<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 13/12/2016
 * Time: 14:07
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\User;
use CodeProject\Presenters\UserPresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    protected $fieldSearchable = [
        'name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function boot()
    {
        return $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UserPresenter::class;
    }
}