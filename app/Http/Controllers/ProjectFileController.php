<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectFileService;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileService
     */
    private $service;

    /**
     * ProjectFileController constructor.
     * @param ProjectFileService $service
     */
    public function __construct(ProjectFileService $service)
    {
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->service->getByProjectId($id);
    }

    public function store(Request $request, $id)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['project_id'] = $id;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['extension'] = $extension;
        $data['file'] = $file;

        return $this->service->store($data, $id);
    }

    public function show($id, $fileId)
    {
        return $this->service->getByIdFile($id, $fileId);
    }

    public function showFile($id, $fileId)
    {
        return $this->service->download($id, $fileId);
    }

    public function update(Request $request, $id, $fileId)
    {
        return $this->service->update($request->all(), $id, $fileId);
    }

    public function destroy($id, $fileId)
    {
        return $this->service->destroy($id, $fileId);
    }
}
