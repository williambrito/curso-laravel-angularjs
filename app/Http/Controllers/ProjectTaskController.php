<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 10/12/2016
 * Time: 12:19
 */

namespace CodeProject\Http\Controllers;


use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskService
     */
    private $service;

    /**
     * ProjectTaskController constructor.
     * @param ProjectTaskService $service
     */
    public function __construct(ProjectTaskService $service)
    {
        $this->service = $service;
    }

    public function index($id)
    {
        return $this->service->getAllByProjectId($id);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id, $taskId)
    {
        return $this->service->getById($id, $taskId);
    }

    public function update(Request $request, $id, $taskId)
    {
        return $this->service->update($request->all(), $id, $taskId);
    }

    public function destroy($id, $taskId)
    {
        return $this->service->destroy($id, $taskId);
    }
}