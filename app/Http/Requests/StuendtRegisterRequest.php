<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StuendtRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required',
            'cell'      => 'required',
            'gender'    => 'required',
            'class'     => 'required',
            'year'      => 'required',
            'group'     => 'required',
            'shift'     => 'required',
        ];
    }
}
