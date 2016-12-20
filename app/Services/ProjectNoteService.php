<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 01/12/2016
 * Time: 15:50
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteValidator
     */
    private $validator;

    /**
     * ProjectNoteService constructor.
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteValidator $validator
     */
    public function __construct(ProjectNoteRepository $repository,
                                ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getByProjectId($projectId)
    {
        return $this->repository->skipPresenter(false)->findWhere(['project_id' => $projectId]);
    }

    public function getByIdNote($noteId)
    {
        return $this->repository->skipPresenter(false)->find($noteId);
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function update(array $data, $noteId)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $noteId);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 400);
        }
    }

    public function destroy($noteId)
    {
        $this->repository->delete($noteId);
    }
}