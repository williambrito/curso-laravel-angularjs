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

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->service->getAllByProjectId($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $noteId
     * @return \Illuminate\Http\Response
     */
    public function show($id, $noteId)
    {
        return $this->service->getById($id, $noteId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param $noteId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId)
    {
        return $this->service->update($request->all(), $id, $noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $noteId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        return $this->service->destroy($id, $noteId);
    }
}
