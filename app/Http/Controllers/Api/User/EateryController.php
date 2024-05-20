<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\EateryResource;
use App\Models\Eatery;

class EateryController extends Controller
{
    public function index()
    {
        $user = request()->user();

        $eaterys = Eatery::with('image')
            ->LocationMap('location', $user->location->latitude,  $user->location->longitude)
            ->get()
            ->where('location', '!=', null);

        return EateryResource::collection($eaterys);
    }


    public function show(Eatery $eatery)
    {
        return new EateryResource(
            $eatery->load('image', 'products', 'products.images')
        );
    }
}
