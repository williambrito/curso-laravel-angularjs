<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 22/12/2016
 * Time: 09:29
 */

namespace CodeProject\Transformers;


use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract
{
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name
        ];
    }
}