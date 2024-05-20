<?php

namespace App\Http\Resources;

use App\Http\Resources\Helper\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->when(!is_null($this->description), $this->description),
            'price'         => $this->when(!is_null($this->price), $this->price),
            'images'        => ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
