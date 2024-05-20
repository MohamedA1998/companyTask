<?php

namespace App\Models;

use App\Trait\LocationScope;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Order extends Model
{
    use HasFactory, LocationScope;

    protected $fillable = ['user_id', 'product_id', 'amount', 'total_price', 'distance', 'status', 'delivery_id'];

    public static array $STATUS = ['processing', 'delivery', 'received_it'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }



    public function scopeOrderProcessing(Builder|EloquentBuilder $query)
    {
        return $query->where('status', '!=', self::$STATUS[2])->get();
    }
}
