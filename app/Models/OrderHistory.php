<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branch_id',
        'advertisement_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
