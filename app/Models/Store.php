<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'license_number',
        'commercial_register',
        'is_blocked',
        'status'
    ];
    protected $appends = [
        'created_from',
        'plan_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    //! Accessories

    public function getCreatedFromAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getPlanNameAttribute()
    {

        $latestSubscription = $this->user->subscriptions()
            ->latest()
            ->first();


        return $latestSubscription?->plan?->name ?? '';
    }
}
