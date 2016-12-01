<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * ClientController constructor.
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->repository->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->repository->find($id);
        if (!$client){
            return response()->json(['erro'=>'Ops. Cliente inexistente!'],404);
        }
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = $this->repository->find($id);
        if (!$client){
            return response()->json(['erro'=>'Ops. Cliente inexistente!'],404);
        }
        $client->fill($request->all());
        $client->save();
        return $this->repository->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = $this->repository->find($id);
        if (!$client){
            return response()->json(['erro'=>'Ops. Cliente inexistente!'],404);
        }
        $client->delete();
        return response()->json([],202);
    }
}
