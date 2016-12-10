<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 01/12/2016
 * Time: 14:07
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }
}