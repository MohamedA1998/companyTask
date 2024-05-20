<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDeliveryResource extends JsonResource
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
            // Order
            'id'                                    => $this->id,
            'total_price'                           => $this->total_price,
            'amount'                                => $this->amount,
            'distance_from_eatery_to_user'          => $this->distance,
            'product'                               => $this->product->name,
            'eatery'                                => $this->product->eatery->name,
            'order_location'                        => new LocationResource($this->product->eatery->location),

            // User
            'user_name'                             => $this->user->username,
            'user_phone'                            => $this->user->phone,
            'user_location'                         => new LocationResource($this->user->location),

            // Delivery
            'delivery_location' => new LocationResource(
                $request->user()->with('location')->first()->location
            ),
        ];
    }
}
