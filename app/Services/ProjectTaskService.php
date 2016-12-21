<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 21/12/2016
 * Time: 09:06
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
    public function __construct(ProjectTaskRepository $repository,
                                ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getByProjectId($projectId)
    {
        return $this->repository->skipPresenter(false)->findWhere(['project_id' => $projectId]);
    }

    public function getById($taskId)
    {
        return $this->repository->skipPresenter(false)->find($taskId);
    }

    public function store(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter(false)->create($data);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function update(array $data, $taskId)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter(false)->update($data, $taskId);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function destroy($taskId)
    {
        $this->repository->delete($taskId);
    }
}