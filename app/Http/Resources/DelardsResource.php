<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DelardsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'plan_name'      => $this->plan_name,
            'created_from'   => $this->created_from,
            'owner_name'     => $this->user?->first_name . ' ' . $this->user?->last_name,
            'branches_count' => $this->branches_count,
        ];
    }
}
