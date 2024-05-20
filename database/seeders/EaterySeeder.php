<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Database\Seeder;

class EaterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eatery::factory(150)->create();

        $eaterys = Eatery::all();
        foreach ($eaterys as $eatery) {
            Image::factory()->create([
                'imageable_type'    => Eatery::class,
                'imageable_id'      => $eatery->id,
            ]);

            Location::factory()->create([
                'locationable_type'    => Eatery::class,
                'locationable_id'      => $eatery->id,
            ]);
        }
    }
}
