<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 22/12/2016
 * Time: 09:42
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{
    /**
     * @var ProjectMemberRepository
     */
    private $repository;
    /**
     * @var ProjectMemberValidator
     */
    private $validator;

    /**
     * ProjectMemberService constructor.
     * @param ProjectMemberRepository $repository
     * @param ProjectMemberValidator $validator
     */
    public function __construct(ProjectMemberRepository $repository,
                                ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getByProjectId($projectId)
    {
        return $this->repository->skipPresenter(false)->findWhere(['project_id' => $projectId]);
    }

    public function getById($id)
    {
        return $this->repository->skipPresenter(false)->find($id);
    }

    public function create(array $data)
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

    public function delete($id)
    {
        $this->repository->delete($id);
    }
}