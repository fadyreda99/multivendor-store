<?php

namespace App\Http\Requests\Categories;

use App\Rules\filter;
use Illuminate\Foundation\Http\FormRequest;

class CAtegoryValidationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('category');
        $filter = new Filter(['laravel', 'html']);
        return [
            'name' => [
                "required",
                "string",
                "min:3",
                "max:255",
                "unique:categories,name,$id,id",
                "filter:php,css"
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'image',
            'status' => 'in:active,archived'
        ];
    }
}
