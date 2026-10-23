<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProductResource extends JsonResource
{
    // Format JSON output produk
    public function toArray($request): array
    {
        return [
            'id'          => $this->product_id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'artist'      => $this->artist,
            'format'      => $this->format,
            'price'       => (float) $this->price,
            'stock'       => (int) $this->stock,
            'category'    => [
                'id'   => $this->category_id,
                'name' => $this->category?->category,
            ],
            'desc'        => $this->description,
            'description' => $this->description,
            'img_url'     => $this->img ? (Str::startsWith($this->img, 'http') ? $this->img : url('storage/' . $this->img)) : null,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
