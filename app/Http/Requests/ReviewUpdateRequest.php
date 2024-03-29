<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
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
            'reviewer_id' => ['required', 'integer', 'exists:reviewers,id'],
            'rating' => ['required', 'integer'],
            'comment' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'integer', 'exists:parents,id'],
        ];
    }
}
