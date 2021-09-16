<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Info;

class CoinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $method = $this->method();
        switch ($this->method()) {
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

        if ($this->method() == 'GET')
            return [];


        return [];
    }


}
