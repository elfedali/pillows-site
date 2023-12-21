<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
            'owner_id' => ['required', 'integer', 'exists:owners,id'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:places,slug'],
            'slogan' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'is_approved' => ['required'],
            'is_active' => ['required'],
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
            'website' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'zip_code' => ['nullable', 'string'],
            'max_guests' => ['required', 'integer'],
            'num_bedrooms' => ['required', 'integer'],
            'num_beds' => ['required', 'integer'],
            'num_baths' => ['required', 'integer'],
            'superficy' => ['required', 'integer'],
            'check_in_hour' => ['required', 'integer'],
            'check_out_hour' => ['required', 'integer'],
            'cancellation_policy' => ['required', 'string'],
            'min_stay' => ['required', 'integer'],
            'max_stay' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'currency' => ['required', 'string'],
        ];
    }
}
