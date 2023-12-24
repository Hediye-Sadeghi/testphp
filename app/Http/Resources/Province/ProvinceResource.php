<?php

namespace App\Http\Resources\Province;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "createdAt" => convertDateToFarsi($this->created_at),
            "updatedAt" => convertDateToFarsi($this->updated_at)
        ];
    }
}
