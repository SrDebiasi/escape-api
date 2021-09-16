<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
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
     * Store a new user.
     *
     * @param RoomRequest $request
     * @return Response
     */
    public function index(RoomRequest $request)
    {
        $params = $request->all();
        $request->merge([
            'company_id' => $params['company'],
            'enable' => true
        ]);
        $response = $this->roomRepository->index($request->all());

        return $this->response($response);
    }


}
