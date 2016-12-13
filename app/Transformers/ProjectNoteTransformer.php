<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 13/12/2016
 * Time: 22:43
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{
    public function transform(ProjectNote $projectNote)
    {
        return [
            'id' => $projectNote->id,
            'project_id' => $projectNote->project_id,
            'title' => $projectNote->title,
            'note' => $projectNote->note
        ];
    }
}