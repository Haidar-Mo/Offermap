<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'longitude' => $this->branch->longitude,
            'latitude' => $this->branch->latitude,
            'title' => $this->title,
            'status' => $this->status,
            'created_from'=>$this->created_from
        ];
    }
}
