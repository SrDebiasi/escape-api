<?php


namespace App\Repositories\Interfaces;

interface ScheduleRepositoryI
{
  public function index($input);

  public function store($input);

  public function show($id, $input);

  public function update($id, $input);
}
