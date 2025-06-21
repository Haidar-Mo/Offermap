<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'name',
        'latitude',
        'longitude',
        'type',
        'contact_number',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function orderHistory()
    {
        return $this->hasMany(OrderHistory::class);
    }


    //! Accessories

    public function getRateAttribute()
    {
        return $this->rates()->count() > 0 ? $this->rates()->sum('rate') / $this->rates()->count() : 0;
    }
}
