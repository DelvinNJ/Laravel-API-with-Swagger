<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'handle'=> $this->handle,
            'htmlContent'=> $this->html_content,
            'status'=> $this->status, 
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
