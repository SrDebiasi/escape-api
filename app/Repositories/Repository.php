<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RoomRepositoryI;

class Repository
{
  /**
   * @response
   *
   * @param * $data
   * @param Int $code
   * @return Array
   */
  public function response($data = null, $code = null)
  {
    $data = !empty($data) ? $data : null;
    $code = !empty($code) ? $code : (empty($data) ? 204 : 200);

    return ['code' => $code, 'data' => $data];
  }
}
