<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EateryResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'image'     => $this->image->url(),
            'location'  => new LocationResource($this->whenLoaded('location')),
            'products'  => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
