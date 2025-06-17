<?php

namespace App\Filters\Mobile;

use App\Filters\BaseFilter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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