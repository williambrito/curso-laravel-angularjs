<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 16/12/2016
 * Time: 12:29
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    private $repository;
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
     * @param Filesystem $filesystem
     * @param Storage $storage
     * @param ProjectFileValidator $validator
     */
    public function __construct(ProjectFileRepository $repository,
                                Filesystem $filesystem,
                                Storage $storage,
                                ProjectFileValidator $validator)
    {
        $this->repository = $repository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->validator = $validator;
    }

    public function getByProjectId($projectId)
    {
        return $this->repository->skipPresenter(false)->findWhere(['project_id' => $projectId]);
    }

    public function getByIdFile($fileId)
    {
        return $this->repository->skipPresenter(false)->find($fileId);
    }

    public function store(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $projectFile = $this->repository->create($data);
            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
            return $this->repository->skipPresenter(false)->find($projectFile->id);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function update(array $data, $fileId)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->skipPresenter(false)->update($data, $fileId);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function destroy($fileId)
    {
        $projectFile = $this->repository->find($fileId);

        if ($this->storage->exists($projectFile->getFileName())) {
            $this->storage->delete($projectFile->getFileName());
            $projectFile->delete();
        }
    }

    public function download($fileId)
    {
        $filePath = $this->getFilePath($fileId);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);

        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->repository->find($fileId)->getFileName()
        ];
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
                    . '/' . $projectFile->getFileName();
        }
        return null;
    }
}