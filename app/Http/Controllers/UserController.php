<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->skipPresenter(false)->all();
    }

    public function authenticated()
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->skipPresenter(false)->find($userId);
    }
}
