<?php


namespace App\Repositories\Interfaces;

interface CompanyRepositoryI
{
  public function index($input);

  public function store($input);

  public function update($input);
}
