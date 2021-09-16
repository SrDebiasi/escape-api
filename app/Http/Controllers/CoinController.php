<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoinRequest;
use App\Repositories\CoinRepository;

class CoinController extends Controller
{

    protected $coinRepository;

    /**
     * Construct the controller.
     *
     * @param CoinRepository $coinRepository
     * @return void
     */
    function __construct(CoinRepository $coinRepository)
    {
        $this->coinRepository = $coinRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CoinRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoinRequest $request)
    {
        $response = $this->coinRepository->store($request->all());

        return $this->response($response);
    }

}
