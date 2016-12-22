<?php
/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 22/12/2016
 * Time: 09:54
 */

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectMemberService;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberService
     */
    private $service;

    /**
     * ProjectMemberController constructor.
     * @param ProjectMemberService $service
     */
    public function __construct(ProjectMemberService $service)
    {
        $this->service = $service;
        $this->middleware('check-project-owner', ['except' => ['index', 'show']]);
        $this->middleware('check-project-permission', ['except' => ['store', 'destroy']]);
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

    public function show($id, $projectMemberId)
    {
        return $this->service->getById($projectMemberId);
    }

    public function destroy($id, $projectMemberId)
    {
        return $this->service->delete($projectMemberId);
    }
}