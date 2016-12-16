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
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
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
    public function __construct(ProjectRepository $repository,
                                ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getAll()
    {
        return $this->repository->skipPresenter(false)->findWhere(['owner_id' => Authorizer::getResourceOwnerId()]);
    }

    public function getById($id)
    {
        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access forbidden'];
        }
        return $this->repository->skipPresenter(false)->find($id);
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter(false)->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access forbidden'];
        }

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter(false)->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroy($id)
    {
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access forbidden'];
        }

        $this->repository->delete($id);
    }

    private function checkProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $merberId = Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $merberId);
    }

    private function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)) {
            return true;
        }

        return false;
    }
}