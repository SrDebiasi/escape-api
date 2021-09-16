<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Room;

class RoomRequest extends FormRequest
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
        $resource      = Room::findOrFail($this->route('id'));
        $companyId     = $resource->company_id;
        $hasCompany = Auth::user()->companies->filter(function ($company) use ($companyId)
        {
          return $company->id == $companyId;
        });
        return count($hasCompany) > 0;
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
        //'company_id' => 'required|exists:company,id', //Access by auth
      ];
    //POST
    if ($this->method() == 'POST')
      return [
        'company_id' => 'required|exists:company,id',
        'name' => 'required|max:255',
        'enable' => 'required',
        'vacancies' => 'required',
        'play_time' => 'required',
        'schedule_type' => 'required',
      ];

    //PUT
    if ($this->method() == 'PUT')
      return [
        'name' => 'required|max:255',
        'enable' => 'required',
        'vacancies' => 'required',
        'play_time' => 'required',
        'schedule_type' => 'required',
      ];

    return [];
  }


}
