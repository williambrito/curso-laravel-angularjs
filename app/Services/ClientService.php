<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 01/12/2016
 * Time: 15:50
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepository;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * ClientService constructor.
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->repository->update($data,$id);
    }
}