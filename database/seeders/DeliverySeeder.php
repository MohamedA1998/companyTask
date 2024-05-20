<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::factory(100)->create();

        $deliverys = Delivery::all();

        foreach ($deliverys as $delivery) {
            Image::factory()->create([
                'imageable_type'    => Delivery::class,
                'imageable_id'      => $delivery->id,
            ]);

            Location::factory()->create([
                'locationable_type'    => Delivery::class,
                'locationable_id'      => $delivery->id,
            ]);
        }
    }
}
