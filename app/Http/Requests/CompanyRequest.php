<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
    //POST
    if ($this->method() == 'POST')
      return [
        'name' => 'required|max:255',
        'body' => 'required',
      ];

    //PUT
    if ($this->method() == 'PUT')
      return [
        'name' => 'required|max:255',
        'body' => 'required',
      ];

    return [];
  }


}
