<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Repositories\Interfaces\RoomRepositoryI;


class RoomController extends Controller
{
    protected $roomRepository;

    /**
     * Construct the controller.
     *
     * @param RoomRepositoryI $roomRepository
     * @return void
     */
    function __construct(RoomRepositoryI $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RoomRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        $response = $this->roomRepository->store($request->all());

        return $this->response($response);
    }


    /**
     * Store a new user.
     *
     * @param RoomRequest $request
     * @return Response
     */
    public function index(RoomRequest $request)
    {
        $response = $this->roomRepository->index($request->all());

        return $this->response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param RoomRequest $request
     * @return Response
     */
    public function show($id, RoomRequest $request)
    {
        $response = $this->roomRepository->show($id, $request->all());

        return $this->response($response);
    }

    /**
     * Destroy the specified resource.
     *
     * @param int $id
     * @param RoomRequest $request
     * @return Response
     */
    public function destroy($id, RoomRequest $request)
    {
        $response = $this->roomRepository->destroy($id, $request->all());

        return $this->response($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomRequest $request
     * @param int $id
     * @return Response
     */
    public function update($id, RoomRequest $request)
    {
        $response = $this->roomRepository->update($id, $request->all());

        return $this->response($response);
    }


}
