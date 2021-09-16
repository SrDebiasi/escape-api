<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Repositories\Interfaces\ScheduleRepositoryI;


class ScheduleController extends Controller
{
  protected $scheduleRepository;

  /**
   * Construct the controller.
   *
   * @param ScheduleRepositoryI $scheduleRepository
   * @return void
   */
  function __construct(ScheduleRepositoryI $scheduleRepository)
  {
    $this->scheduleRepository = $scheduleRepository;
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param ScheduleRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(ScheduleRequest $request)
  {
    $response = $this->scheduleRepository->store($request->all());

    return $this->response($response);
  }


  /**
   * Store a new user.
   *
   * @param ScheduleRequest $request
   * @return Response
   */
  public function index(ScheduleRequest $request)
  {
    $response = $this->scheduleRepository->index($request->all());

    return $this->response($response);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @param ScheduleRequest $request
   * @return Response
   */
  public function show($id, ScheduleRequest $request)
  {
    $response = $this->scheduleRepository->show($id, $request->all());

    return $this->response($response);
  }

  /**
   * Destroy the specified resource.
   *
   * @param int $id
   * @param ScheduleRequest $request
   * @return Response
   */
  public function destroy($id, ScheduleRequest $request)
  {
    $response = $this->scheduleRepository->destroy($id, $request->all());

    return $this->response($response);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ScheduleRequest $request
   * @param int $id
   * @return Response
   */
  public function update($id, ScheduleRequest $request)
  {
    $response = $this->scheduleRepository->update($id, $request->all());

    return $this->response($response);
  }


}
