<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 16/12/2016
 * Time: 10:56
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
    public function transform(ProjectFile $projectFile)
    {
        return [
            'id' => $projectFile->id,
            'project_id' => $projectFile->project_id,
            'name' => $projectFile->name,
            'description' => $projectFile->description,
            'extension' => $projectFile->extension
        ];
    }
}