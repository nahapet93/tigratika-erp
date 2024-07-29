<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'amount' => $this->amount,
            'laser' => $this->laser,
            'welding' => $this->welding,
            'assembly' => $this->assembly,
            'electricity' => $this->electricity,
            'source' => $this->source->name,
            'children' => self::collection($this->children)
        ];
    }
}
