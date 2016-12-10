<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 10/12/2016
 * Time: 12:20
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;
    /**
     * @var ProjectTaskValidator
     */
    private $validator;

    /**
     * ProjectTaskService constructor.
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getAllByProjectId($projectId)
    {
        return $this->repository->findWhere(['project_id' => $projectId]);
    }

    public function getById($id, $taskId)
    {
        $note = $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);

        if (count($note) === 0) {
            return response()->json(['error' => 'Task inexistente!'], 404);
        }
        return $note;
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

    public function update(array $data, $id, $taskId)
    {
        $result = $this->getById($id, $taskId);

        if (!json_decode($result)) {
            return $result;
        }

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $taskId);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroy($id, $taskId)
    {
        $result = $this->getById($id, $taskId);

        if (!json_decode($result)) {
            return $result;
        }

        try {
            $this->repository->delete($taskId);
            return response()->json([], 202);

        } catch (\PDOException $pe) {
            return response()->json(['error' => 'Task possui dependências!'], 404);
        }
    }
}