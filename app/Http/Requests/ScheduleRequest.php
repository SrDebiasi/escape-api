<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;

class ScheduleRequest extends FormRequest
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
        $resource   = Schedule::with('timetable.room')->findOrFail($this->route('id'));
        $companyId  = $resource->timetable->room->company_id;
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
        'timetable_id' => 'required|exists:timetable,id',
        'user_id' => 'required|exists:user,id',
        'voucher_id' => 'nullable|exists:voucher,id',
        'name' => 'required|max:255',
        'phone' => 'required|max:255',
        'email' => 'required',
        'quantity' => 'required',
        'payment_value' => 'required',
        'payment_type' => 'required',
        'paid' => 'required',
      ];

    //PUT
    if ($this->method() == 'PUT')
      return [
        'timetable_id' => 'required|exists:timetable,id',
        'user_id' => 'required|exists:user,id',
        'voucher_id' => 'nullable|exists:voucher,id',
        'name' => 'required|max:255',
        'phone' => 'required|max:255',
        'email' => 'required',
        'quantity' => 'required',
        'payment_value' => 'required',
        'payment_type' => 'required',
        'paid' => 'required',
      ];

    return [];
  }


}
