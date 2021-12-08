<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MangaResource extends JsonResource
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
            'chapters' => $this->chapters,
            'genres' => json_decode($this->genres),
            'rating' => $this->rating,
            'year' => $this->year,
            'status' => $this->status,
            'image' => $this->image,
            'mangaka' => MangakaResource::make($this->mangakas)
        ];
    }
}
