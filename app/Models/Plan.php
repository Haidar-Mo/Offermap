<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'size',
        'duration'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
