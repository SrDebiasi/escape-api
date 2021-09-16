<?php

namespace App\Http\Requests\External;

use Illuminate\Foundation\Http\FormRequest;


class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {

            //POST
            case 'POST':
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
                'timetable_id' => 'required|exists:timetable,id',
                'voucher_id' => 'nullable|exists:voucher,id',
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'email' => 'required',
                'quantity' => 'required'
            ];

        return [];
    }


}
