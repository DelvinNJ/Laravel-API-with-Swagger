<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 
            'collection' => new CollectionResource($this->whenLoaded('collection'))
            // 'title' =>$this->collection->title
        ];
    }
}
