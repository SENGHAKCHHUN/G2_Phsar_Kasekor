<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "frontuser" => $this->frontuser,
            "phone_number" => $this->phone_number,
            "address" => $this->address,
            "products" => ListProductResource::collection($this->products)
        ];
    }
}
