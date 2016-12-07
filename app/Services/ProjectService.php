<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 01/12/2016
 * Time: 15:50
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;

    /**
     * ProjectService constructor.
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {

        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getAll()
    {
        return $this->repository->with(['owner', 'client'])->paginate();
    }

    public function getById($id)
    {
        try {
            return $this->repository->with(['owner', 'client'])->find($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Projeto inexistente!'], 404);
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
                return response()->json(['error' => 'Projeto possui dependências!'], 404);
            }
        } catch (ModelNotFoundException $me) {
            return response()->json(['error' => 'Projeto inexistente!'], 404);
        }
    }
}