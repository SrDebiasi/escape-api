<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  /**
   * @response
   *
   * @param * pack
   * @return Array
   */
  public function response($pack = null)
  {
    $data = !empty($pack['data']) ? $pack['data'] : $pack;
    $code = !empty($pack['code']) ? $pack['code'] : (empty($data) ? 204 : 200);

    return response()->json($data, $code);
  }

}
