<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 16/12/2016
 * Time: 12:29
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;
    /**
     * @var ProjectFileValidator
     */
    private $validator;

    /**
     * ProjectFileService constructor.
     * @param ProjectFileRepository $repository
     * @param ProjectRepository $projectRepository
     * @param Filesystem $filesystem
     * @param Storage $storage
     * @param ProjectFileValidator $validator
     */
    public function __construct(ProjectFileRepository $repository,
                                ProjectRepository $projectRepository,
                                Filesystem $filesystem,
                                Storage $storage,
                                ProjectFileValidator $validator)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->validator = $validator;
    }

    public function getByProjectId($projectId)
    {
        if ($this->checkProjectPermissions($projectId) == false) {
            return ['error' => 'Access forbidden'];
        }
        return $this->repository->skipPresenter(false)->findWhere(['project_id' => $projectId]);
    }

    public function store(array $data, $id)
    {
        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access forbidden'];
        }

        try {
            $this->validator->with($data)->passesOrFail();

            $projectFile = $this->repository->create($data);
            $this->storage->put($projectFile->id . "." . $projectFile->extension, $this->filesystem->get($data['file']));

            return $this->repository->skipPresenter(false)->find($projectFile->id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function getByIdFile($id, $fileId)
    {
        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access forbidden'];
        }
        return $this->repository->skipPresenter(false)->find($fileId);
    }

    public function update(array $data, $id, $fileId)
    {
        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access forbidden'];
        }
        return $this->repository->skipPresenter(false)->update($data, $fileId);
    }

    public function destroy($id, $fileId)
    {
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access forbidden'];
        }
        $this->repository->delete($fileId);
    }

    public function download($id, $fileId)
    {
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access forbidden'];
        }
        return response()->download($this->getFilePath($fileId));
    }

    private function getFilePath($fileId)
    {
        $projectFile = $this->repository->find($fileId);
        return $this->getBaseURL($projectFile);
    }

    private function getBaseURL($projectFile)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                    . '/' . $projectFile->id . '.' . $projectFile->extension;
        }
        return null;
    }

    private function checkProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->projectRepository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $merberId = Authorizer::getResourceOwnerId();
        return $this->projectRepository->hasMember($projectId, $merberId);
    }

    private function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)) {
            return true;
        }
        return false;
    }
}