<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id'=>$this->user_id,
            'title' => $this->title,
            'longitude' => $this->branch->longitude,
            'latitude' => $this->branch->latitude,
            'title' => $this->title,
            'description'=>$this->description,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'price'=>$this->price,
            'discount_ratio'=>$this->discount_ratio,
            'status' => $this->status,
            'created_from'=>$this->created_from
        ];
    }
}
