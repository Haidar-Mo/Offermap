<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'price',
        'discount_ratio',
        'status',
    ];



    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function orderHistory()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
