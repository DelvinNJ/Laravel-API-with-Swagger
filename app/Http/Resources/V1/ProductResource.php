<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use App\Http\Resources\V1\CollectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 
            'title' => $this->title,
            'handle' => $this->handle,
            'htmlContent' => $this->html_content,
            'vendor' => $this->vendor,
            'productType' => $this->product_type,
            'status' => $this->status, 
            'collections' => CollectionResource::collection($this->whenLoaded('collections'))
            
            // 'collections' => CollectionProductResource::collection($this->whenLoaded('collection_products')), // Inner connection
            // 'collection_map' => $this->collection_products->map(function($collection){
            //     return [
            //         'id' => $collection->collection->id,
            //         'title' => $collection->collection->title
            //     ];
            // })
        ];
    }
}
