<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 02/12/2016
 * Time: 22:43
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name
        ];
    }
}