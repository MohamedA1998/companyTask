<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Eatery;
use App\Models\Product;
use App\Notifications\OrderPrice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(
            request()->user()->orders()->with('product:id,name', 'product.images')->OrderProcessing()
        );
    }


    public function store(Request $request, Product $product)
    {
        $request->validate([
            'amount'        => 'required|numeric|min:1',
        ]);

        $totalPrice = $product->price * $request->amount;

        $user = $request->user();

        $distance = (float) Eatery::LocationMap('location', $user->location->latitude, $user->location->longitude)
            ->find($product->eatery_id)->location->distance;

        $product->orders()->create([
            'user_id'       => $user->id,
            'amount'        => $request->amount,
            'total_price'   => $totalPrice,
            'distance'      => round($distance, 3)
        ]);

        $user->notify(new OrderPrice());

        return response('Success order stored', 201);
    }
}
