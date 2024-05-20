<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'amount'        => $this->amount,
            'total_price'   => $this->total_price,
            'status'        => $this->status,
            'created_at'    => $this->created_at->diffForHumans(),
            'product'       => new ProductResource($this->product),
        ];
    }
}
