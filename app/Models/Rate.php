<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'branch_id',
        'rate',
        'comment'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
