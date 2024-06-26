<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $isPUT = $this->isMethod('PUT') ?? false;
        return [
            'title' =>  $isPUT ? ['required'] : ['required', 'sometimes'],
            'htmlContent' => $isPUT ? ['required'] : ['required', 'sometimes'],
            'productType' => $isPUT ? ['required'] : ['required', 'sometimes'],
            'vendor' => $isPUT ? ['required'] : ['required', 'sometimes'],
        ];
    }

    // rewrite field names with table field names (This step is optional when you want to rewrite the fields) 
    public function prepareForValidation(): void
    {
        $fields = [
            'html_content' => 'htmlContent',
            'product_type' => 'productType',
        ];
        $data = [];
        foreach ($fields as $key => $value) {
            if ($this->$value) {
                $data[$key] = $this->$value;  // $this->htmlContent - In array htmlContent is string so need to convert as variable.
            }
        }
        $this->merge($data);
    }
}
