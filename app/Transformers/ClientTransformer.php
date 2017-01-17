<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 14/12/2016
 * Time: 22:43
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projects'];

    public function transform(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs,
        ];
    }

    public function includeProjects(Client $client)
    {
        $projectTransformer = new ProjectTransformer();
        $projectTransformer->setDefaultIncludes([]);
        return $this->collection($client->projects, $projectTransformer);
    }
}