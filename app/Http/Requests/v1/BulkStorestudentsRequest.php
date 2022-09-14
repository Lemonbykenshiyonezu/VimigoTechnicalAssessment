<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStorestudentsRequest extends FormRequest
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
            '*.name'=>['required'],
            '*.email'=>['required','email'],
            '*.address'=>['required'],
            '*.studycourse'=>['required',Rule::in(['comsci','gamedev','gamedesign'])]
        ];
    }
    protected function prepareForValidation(){
        $data=[];

        foreach ($this->toArray() as $obj){
            $obj['name']=$obj['name'] ?? null;
            $obj['email']=$obj['email'] ?? null;
            $obj['address']=$obj['address'] ?? null;
            $obj['studycourse']=$obj['studycourse'] ?? null;

            $data[]= $obj;
        }
        $this->merge($data);
    }
}
