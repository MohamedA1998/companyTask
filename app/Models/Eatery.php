<?php

namespace App\Models;

use App\Trait\LocationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Eatery extends Model
{
    use HasFactory, LocationScope;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locationable');
    }
}
