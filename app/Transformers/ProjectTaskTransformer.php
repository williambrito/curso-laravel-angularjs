<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 21/12/2016
 * Time: 08:57
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{
    public function transform(ProjectTask $projectTask)
    {
        return [
            'id' => $projectTask->id,
            'project_id' => $projectTask->project_id,
            'name' => $projectTask->name,
            'start_date' => $projectTask->start_date,
            'due_date' => $projectTask->due_date,
            'status' => $projectTask->status
        ];
    }
}