<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 22/12/2016
 * Time: 09:16
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\ProjectMember;
use CodeProject\Presenters\ProjectMemberPresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectMember::class;
    }

    public function boot()
    {
        return $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }
}