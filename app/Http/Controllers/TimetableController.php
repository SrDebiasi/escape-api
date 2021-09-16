<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimetableRequest;
use App\Repositories\Interfaces\TimetableRepositoryI;


class TimetableController extends Controller
{
  protected $TimetableRepository;

  /**
   * Construct the controller.
   *
   * @param TimetableRepositoryI $TimetableRepository
   * @return void
   */
  function __construct(TimetableRepositoryI $TimetableRepository)
  {
    $this->TimetableRepository = $TimetableRepository;
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param TimetableRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(TimetableRequest $request)
  {
    $response = $this->TimetableRepository->store($request->all());

    return $this->response($response);
  }


  /**
   * Store a new user.
   *
   * @param TimetableRequest $request
   * @return Response
   */
  public function index(TimetableRequest $request)
  {
    $response = $this->TimetableRepository->index($request->all());

    return $this->response($response);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @param TimetableRequest $request
   * @return Response
   */
  public function show($id, TimetableRequest $request)
  {
    $response = $this->TimetableRepository->show($id, $request->all());

    return $this->response($response);
  }

  /**
   * Destroy the specified resource.
   *
   * @param int $id
   * @param TimetableRequest $request
   * @return Response
   */
  public function destroy($id, TimetableRequest $request)
  {
    $response = $this->TimetableRepository->destroy($id, $request->all());

    return $this->response($response);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param TimetableRequest $request
   * @param int $id
   * @return Response
   */
  public function update($id, TimetableRequest $request)
  {
    $response = $this->TimetableRepository->update($id, $request->all());

    return $this->response($response);
  }


}
