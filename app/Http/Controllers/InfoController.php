<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Repositories\Interfaces\InfoRepositoryI;


class InfoController extends Controller
{
  protected $InfoRepository;

  /**
   * Construct the controller.
   *
   * @param InfoRepositoryI $InfoRepository
   * @return void
   */
  function __construct(InfoRepositoryI $InfoRepository)
  {
    $this->InfoRepository = $InfoRepository;
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param InfoRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(InfoRequest $request)
  {
    $response = $this->InfoRepository->store($request->all());

    return $this->response($response);
  }


  /**
   * Store a new user.
   *
   * @param InfoRequest $request
   * @return Response
   */
  public function index(InfoRequest $request)
  {
    $response = $this->InfoRepository->index($request->all());

    return $this->response($response);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @param InfoRequest $request
   * @return Response
   */
  public function show($id, InfoRequest $request)
  {
    $response = $this->InfoRepository->show($id, $request->all());

    return $this->response($response);
  }

  /**
   * Destroy the specified resource.
   *
   * @param int $id
   * @param InfoRequest $request
   * @return Response
   */
  public function destroy($id, InfoRequest $request)
  {
    $response = $this->InfoRepository->destroy($id, $request->all());

    return $this->response($response);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param InfoRequest $request
   * @param int $id
   * @return Response
   */
  public function update($id, InfoRequest $request)
  {
    $response = $this->InfoRepository->update($id, $request->all());

    return $this->response($response);
  }


}
