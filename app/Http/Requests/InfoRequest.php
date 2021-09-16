<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Info;

class InfoRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    $method = $this->method();
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
        'company_id' => 'required|exists:company,id',
        'name' => 'required|max:255',
        'value' => 'required',
      ];

    //PUT
    if ($this->method() == 'PUT')
      return [
        'company_id' => 'required|exists:company,id',
        'name' => 'required|max:255',
        'value' => 'required',
      ];

    return [];
  }


}
