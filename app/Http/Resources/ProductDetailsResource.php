<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'brand' => $this->brand,
            'price' => $this->price,
            'description' => $this->description,
            'image_path' => $this->image_path,
            'company_name' => $this->company_name
        ];
    }
}
