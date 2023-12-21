<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'owner_id' => $this->owner_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'is_approved' => $this->is_approved,
            'is_active' => $this->is_active,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
            'max_guests' => $this->max_guests,
            'num_bedrooms' => $this->num_bedrooms,
            'num_beds' => $this->num_beds,
            'num_baths' => $this->num_baths,
            'superficy' => $this->superficy,
            'check_in_hour' => $this->check_in_hour,
            'check_out_hour' => $this->check_out_hour,
            'cancellation_policy' => $this->cancellation_policy,
            'min_stay' => $this->min_stay,
            'max_stay' => $this->max_stay,
            'price' => $this->price,
            'currency' => $this->currency,
            'tags' => TagCollection::make($this->whenLoaded('tags')),
            'contacts' => ContactCollection::make($this->whenLoaded('contacts')),
        ];
    }
}
