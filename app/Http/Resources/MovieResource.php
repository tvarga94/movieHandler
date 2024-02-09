<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'director' => $this->director,
            'cast' => $this->cast,
            'category' => $this->category,
            'releaseDate' => $this->releaseDate,
        ];
    }
}
