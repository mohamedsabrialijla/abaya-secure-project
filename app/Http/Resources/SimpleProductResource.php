<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SimpleProductResource extends JsonResource
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
            "id"=>$this->id,
            "name"=>$this->name,
            "discount_ratio"=>$this->discount_ratio,
            "details"=>$this->details,
            "main_image"=>$this->image_url,
            "has_discount"=>$this->has_discount,
            "price"=>$this->price,
            "sale_price"=>$this->sale_price,
            "is_feature"=>$this->is_feature,
            "feature_image_url"=>$this->feature_image_url,
            "annotation"=>$this->annotation,
            "in_favorite"=>$this->in_favorite,
            "designer"=>DesignerResource::make($this->designer),
            "sizes"=>ProductSizeResource::collection($this->sizes),
            ];
    }
}
