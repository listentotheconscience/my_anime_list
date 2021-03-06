<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'episodes' => $this->episodes,
            'genres' => json_decode($this->genres),
            'rating' => $this->rating,
            'season' => $this->season,
            'status' => $this->status,
            'image' => $this->image,
            'producer' => ProducerResource::make($this->producers),
            'studio' => StudioResource::make($this->studios),
            'licensor' => LicensorResource::make($this->licensors)
        ];
    }
}
