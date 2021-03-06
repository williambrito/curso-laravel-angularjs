<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 02/12/2016
 * Time: 22:43
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['client', 'members'];

    public function transform(Project $project)
    {
        return [
            'id' => $project->id,
            'owner_id' => $project->owner_id,
            'client_id' => $project->client_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => (int)$project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
            'is_menber' => ($project->owner_id != Authorizer::getResourceOwnerId())
        ];
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new MemberTransformer());
    }
}