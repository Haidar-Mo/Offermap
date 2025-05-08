<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
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
}
