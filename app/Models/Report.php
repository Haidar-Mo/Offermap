<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reportable_id',
        'reportable_type',
        'paragraph',
        'is_read',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ads(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }

    /*public function dealer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }*/

    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }
}
