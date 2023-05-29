<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $rules =  [
            'name' => ['required','string'],
            'address' => ['required','string'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email', 'unique:students,email'],
            'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
            'gender' => ['required'],
            'dob' => ['required', 'date'],
            'level' => ['required'],
            'college' => ['required'],
            'university' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required']
        ];
        if(in_array($this->method(), ["PUT", "PATCH"])){
            $rules =  [
                'name' => ['required','string'],
                'address' => ['required','string'],
                'phone' => ['required', 'numeric'],
                'email' => ['required', 'email', Rule::unique('students')->ignore($this->route('student')) ],
                'image_path' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
                'gender' => ['required'],
                'dob' => ['required', 'date'],
                'level' => ['required'],
                'college' => ['required'],
                'university' => ['required'],
                'start_date' => ['required'],
                'end_date' => ['required']
            ];
        }

        return $rules;
    }
}
