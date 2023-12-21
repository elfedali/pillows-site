<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'author_id' => $this->author_id,
            'is_published' => $this->is_published,
            'tags' => TagCollection::make($this->whenLoaded('tags')),
            'images' => ImageCollection::make($this->whenLoaded('images')),
        ];
    }
}
