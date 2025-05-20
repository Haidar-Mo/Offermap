<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\{
    HasPermissions,
    HasRoles
};

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasRoles, HasPermissions, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $guard_name = 'api';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'created_from',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function reported()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function orders()
    {
        return $this->hasMany(OrderHistory::class, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediaable');
    }

    //! Accessories

    public function getIsFullRegisteredAttribute()
    {
        return $this->first_name && $this->last_name && $this->phone_number ? true : false;
    }

    public function getCreatedFromAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
