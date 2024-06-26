<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class CollectionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isPUT = $this->isMethod('PUT') ?? false;
        return [
            'title' => $isPUT ? ['required'] : ['required', 'sometimes'],
            'htmlContent' => $isPUT ? ['required'] : ['required', 'sometimes']
        ];
    }
    public function prepareForValidation()
    {
        $fields = [
            'html_content' => 'htmlContent'
        ];
        $data = [];
        foreach ($fields as $key => $value) {
            if ($this->$value) {
                $data[$key] =  $this->$value;
            }
        }
        $this->merge($data);
    }
}
