<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'provinsi_id' => $this->provinsi_id,
            'kabupaten_id' => $this->kabupaten_id,
            'kecamatan_id' => $this->kecamatan_id,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'hs_code' => $this->hs_code,
            'sni' => $this->sni,
            'company_name' => $this->company_name,
            'image_path' => $this->image_path
        ];
        // return parent::toArray($request);
        // "id" => 12
        // "name" => "sepeda gunung"
        // "brand" => "polygon"
        // "price" => 5420000.0
        // "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et lobortis mauris, sed finibus ligula. Nullam sit amet pretium ipsum. Mauris luctus purus quis d ▶"
        // "user_id" => 9
        // "company_name" => "pt sembilan"
        // "provinsi_id" => 13
        // "kabupaten_id" => 2101
        // "kecamatan_id" => 2101010
        // "category_id" => 4
        // "subcategory_id" => 555
        // "hs_code" => "131313"
        // "sni" => 1
        // "image_path" => "images/kulkas3_1595529443.jpg"
        // "created_at" => "2020-07-06 20:12:51"
        // "updated_at" => "2020-07-29 15:08:47"
    }
}
