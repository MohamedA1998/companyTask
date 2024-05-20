<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eaterys = Eatery::all();

        Product::factory(500)->make()->each(function ($product) use ($eaterys) {
            $product->eatery_id = $eaterys->random()->id;

            $product->save();

            $random = rand(1, 9);

            Image::factory($random)->create([
                'imageable_type'    => Product::class,
                'imageable_id'      => $product->id,
            ]);
        });
    }
}
