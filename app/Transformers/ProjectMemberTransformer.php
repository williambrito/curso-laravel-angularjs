<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 02/12/2016
 * Time: 22:43
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['user'];

    public function transform(ProjectMember $member)
    {
        return [
            'project_id' => $member->project_id
        ];
    }

    public function includeUser(ProjectMember $member)
    {
        return $this->item($member->member, new MemberTransformer());
    }
}