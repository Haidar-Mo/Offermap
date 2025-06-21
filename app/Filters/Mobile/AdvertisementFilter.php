<?php

namespace App\Filters\Mobile;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class AdvertisementFilter extends BaseFilter
{

    public function apply(Builder $query)
    {
        if ($this->request->filled('status')) {
            $query->where('status', '=', $this->request->status);
        }

        return $query;
    }
}