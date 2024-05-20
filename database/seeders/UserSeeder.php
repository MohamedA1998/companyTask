<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'Mohamed Alsayed',
            'phone' => '+201095610720',
        ]);

        User::factory(100)->create();

        $users = User::all();

        foreach ($users as $user) {
            Image::factory()->create([
                'imageable_type'    => User::class,
                'imageable_id'      => $user->id,
            ]);

            Location::factory()->create([
                'locationable_type'    => User::class,
                'locationable_id'      => $user->id,
            ]);
        }
    }
}
