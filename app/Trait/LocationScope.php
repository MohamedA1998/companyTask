<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait LocationScope
{
    public function scopeLocationMap(Builder $query, $relashen, $latitude, $longitude, $zoom = 25): Builder
    {
        return $query->with([
            $relashen => fn (Builder|QueryBuilder|MorphOne $query) =>
            $query->select('*')
                ->selectRaw(
                    '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$latitude, $longitude, $latitude]
                )
                ->having('distance', '<', $zoom)
                ->orderBy('distance')
        ]);
    }
}
