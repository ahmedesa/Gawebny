<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "language_id" => "integer" ,
            "country_id" => "integer",
            "jop" => "max:100",
            "education" => "max:200",
            "discreption" => "max:500",
            "image" => "image|mimes:jpeg,bmp,png,jpg"        ];
        }
    }
