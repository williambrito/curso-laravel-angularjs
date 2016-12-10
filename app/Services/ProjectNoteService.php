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
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getAllByProjectId($projectId)
    {
        return $this->repository->findWhere(['project_id' => $projectId]);
    }

    public function getById($id, $noteId)
    {
        $note = $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);

        if (count($note) === 0) {
            return response()->json(['error' => 'Nota inexistente!'], 404);
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

    public function update(array $data, $id, $noteId)
    {
        $result = $this->getById($id, $noteId);

        if (!json_decode($result)) {
            return $result;
        }

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $noteId);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function destroy($id, $noteId)
    {
        $result = $this->getById($id, $noteId);

        if (!json_decode($result)) {
            return $result;
        }

        try {
            $this->repository->delete($noteId);
            return response()->json([], 202);

        } catch (\PDOException $pe) {
            return response()->json(['error' => 'Nota possui dependências!'], 404);
        }
    }
}