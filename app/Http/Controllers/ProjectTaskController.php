<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 21/12/2016
 * Time: 09:17
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
        return $this->service->getByProjectId($id);
    }

    public function show($id, $taskId)
    {
        return $this->service->getById($taskId);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->store($data);
    }

    public function update(Request $request, $id, $taskId)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->update($data, $taskId);
    }

    public function destroy($id, $taskId)
    {
        return $this->service->destroy($taskId);
    }

}