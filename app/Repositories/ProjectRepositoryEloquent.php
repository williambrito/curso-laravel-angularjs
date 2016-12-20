<?php

namespace CodeProject\Repositories;

use CodeProject\Presenters\ProjectPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Entities\Project;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($projectId, $userId)
    {
        if (count($this->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }
        return false;
    }

    public function isMember($projectId, $merberId)
    {
        $project = $this->find($projectId);

        foreach ($project->members as $member) {
            if ($member->id == $merberId) {
                return true;
            }
        }

        return false;
    }

    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projects.*')
                ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.project_id', '=', $userId)
                ->union($this->model->query()->getQuery()->where('owner_id', '=', $userId));
        })->all();
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
