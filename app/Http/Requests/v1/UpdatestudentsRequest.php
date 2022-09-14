<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatestudentsRequest extends FormRequest
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
        $method = $this->method();

        if($method == 'PUT'){
            return [
                'name'=>['required'],
                'email'=>['required','email'],
                'address'=>['required'],
                'studycourse'=>['required',Rule::in(['comsci','gamedev','gamedesign'])]
            ];
        }
        else {
            return [
                'name'=>['sometimes','required'],
                'email'=>['sometimes','required','email'],
                'address'=>['sometimes','required'],
                'studycourse'=>['sometimes','required',Rule::in(['comsci','gamedev','gamedesign'])]
            ];
        }
        
        
    }
}
