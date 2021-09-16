<?php


namespace App\Repositories\Interfaces;

interface TimetableRepositoryI
{
  public function index($input);

  public function store($input);

  public function update($id, $input);
}
