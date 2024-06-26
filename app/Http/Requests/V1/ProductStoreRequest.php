<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return ($user != null  && $user->tokenCan('create'));
    }

    public function rules(): array
    {
        return [
            'title' => ['required'],
            'htmlContent' => ['required'],
            'productType' => ['required', Rule::in(['Food', 'Drinks', 'Electronic'])],
            'vendor' => ['required']
        ];
    }

    // rewrite field names with table field names (This step is optional when you want to rewrite the fields) 
    public function prepareForValidation(): void
    {
        $this->merge([
            'html_content' => $this->htmlContent,
            'product_type' => $this->productType,
        ]);
    }
}
