<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{
    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * ProjectNoteController constructor.
     * @param ProjectNoteService $service
     */
    public function __construct(ProjectNoteService $service)
    {
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->service->getByProjectId($id);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    public function show($id, $noteId)
    {
        return $this->service->getByIdNote($noteId);
    }

    public function update(Request $request, $id, $noteId)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data, $noteId);
    }

    public function destroy($id, $noteId)
    {
        return $this->service->destroy($noteId);
    }
}
