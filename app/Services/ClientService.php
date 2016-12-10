<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 01/12/2016
 * Time: 15:50
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientValidator
     */
    private $validator;

    /**
     * ClientService constructor.
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getAll()
    {
        return $this->repository->paginate();
    }

    public function getById($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cliente inexistente!'], 404);
        }
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        $result = $this->getById($id);

        if (!json_decode($result)) {
            return $result;
        }

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroy($id)
    {
        try {
            $client = $this->repository->find($id);
            try {
                if ($client) {
                    $this->repository->delete($id);
                }
                return response()->json([], 202);
            } catch (\PDOException $pe) {
                return response()->json(['error' => 'Cliente possui dependências!'], 404);
            }
        } catch (ModelNotFoundException $me) {
            return response()->json(['error' => 'Cliente inexistente!'], 404);
        }
    }
}