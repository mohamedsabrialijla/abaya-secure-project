<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            "product_color_id"=>$this->id,
            "color_id"=>$this->color_id,
            "color"=>@$this->color->name,
            "color_hex"=>@$this->color->hexa,
        ];

    }
}
