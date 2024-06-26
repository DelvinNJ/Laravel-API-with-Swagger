<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CollectionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'htmlContent' => ['required']
        ];
    }
    public function prepareForValidation(): void
    {
        $this->merge([
            'html_content' => $this->htmlContent,
        ]);
    }


    // For custom error message, while In API request we set accept application/json in Headers. 
    // -----------------------------------------------------------------------------------------
    // protected function failedValidation(Validator $validator)         
    // {
    //     throw new HttpResponseException(response()->json([
    //         'status' => 'error',
    //         'message' => 'Validation errors',
    //         'errors' => $validator->errors()
    //     ], 422));
    // }
}
