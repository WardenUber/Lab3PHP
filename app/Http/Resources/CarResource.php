<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'model' => $this->model,
            'brand' => $this->brand,
            'power' => $this->power,
            'volume' => $this->volume,
            'dealerships_id' => $this->dealerships_id,
        ];
    }
}
