<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Timetable;

class TimetableRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    switch ($this->method())
    {
      //GET
      case 'GET':
        return true;
        break;

      //POST
      case 'POST':
        return true;
        break;

      //PUT
      case 'PUT':
        return true;
        break;

      //DELETE
      case 'DELETE':
        return true;
        break;

      //DEFAULT
      default:
        return false;
        break;

    }
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    //GET
    if ($this->method() == 'GET')
      return [
      ];
    //POST
    if ($this->method() == 'POST')
      return [
        'room_id' => 'required|exists:room,id',
        'enable' => 'required',
        'start' => 'required',
      ];

    //PUT
    if ($this->method() == 'PUT')
      return [
        'room_id' => 'required|exists:room,id',
        'enable' => 'required',
        'start' => 'required',
      ];

    return [];
  }


}
