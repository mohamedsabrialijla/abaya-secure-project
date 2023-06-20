<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignerWithProductResource extends JsonResource
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
            "id"=>$this->id,
            "image_url"=>$this->image,
            "image_thumbnail_url"=>$this->image_thumbnail,
            "name"=>$this->name,
            "products"=>ProductResource::collection($this->products)
        ];
    }
}
