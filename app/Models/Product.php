<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;


    public function eatery(): BelongsTo
    {
        return $this->belongsTo(Eatery::class);
    }


    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
