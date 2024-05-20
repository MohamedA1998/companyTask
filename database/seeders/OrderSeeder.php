<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\Eatery;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $products = Product::all();

        $deliverys = Delivery::all();

        Order::factory(1000)->make()->each(function ($order) use ($users, $deliverys, $products) {
            $user        = $users->random();
            $delivery    = $deliverys->random();
            $product     = $products->random();

            $distance = (float) Eatery::LocationMap('location', $user->location->latitude, $user->location->longitude, 10000)
                ->find($product->eatery_id)->location->distance;

            $amount = rand(1, 3);
            $status = rand(0, 2);

            if ($status !== 0) {
                $order->delivery_id     = $delivery->id;
            }

            $order->user_id     = $user->id;
            $order->product_id  = $product->id;
            $order->amount      = $amount;
            $order->status      = Order::$STATUS[$status];
            $order->total_price = $order->amount * $product->price;
            $order->distance    = round($distance, 3);

            $order->save();
        });
    }
}
