<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDeliveryResource;
use App\Models\Order;
use App\Notifications\OrderPrice;
use Illuminate\Http\Request;

class OrderDeliveryController extends Controller
{
    public function index()
    {
        $delivery = request()->user();

        $orders = Order::with('user')
            ->LocationMap('product.eatery.location',  $delivery->location->latitude,  $delivery->location->longitude)
            ->where('status', Order::$STATUS[0])
            ->limit(5)
            ->orderBy('distance')
            ->get()
            ->where('product.eatery.location', '!=', null);

        return OrderDeliveryResource::collection($orders);
    }


    public function show(Order $order)
    {
        return new OrderDeliveryResource(
            $order->load('product.eatery.location', 'user.location')
        );
    }


    public function update(Request $request, Order $order)
    {
        $order->update([
            'status'        => Order::$STATUS[1],
            'delivery_id'   => $request->user()->id
        ]);

        $request->user()->notify(new OrderPrice());

        return response()->noContent();
    }
}
