<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:categories,slug'],
            'note' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'integer', 'exists:parents,id'],
        ];
    }
}
