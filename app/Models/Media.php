<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'mediaable_id',
        'mediaable_type',
        'path',
    ];

    protected $appends = ['full_path'];

    public function mediaable()
    {
        return $this->morphTo();
    }

    //! Accessories
    public function getFullPathAttribute()
    {
        return asset($this->path);
    }
}
