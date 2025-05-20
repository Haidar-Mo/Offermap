<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
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
