<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RelatedProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $store=$this->store;
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "discount_ratio"=>$this->discount_ratio,
            "main_image"=>$this->image_url,
            "has_discount"=>$this->has_discount,
            "price"=>$this->price,
            "sale_price"=>$this->sale_price,
            "is_feature"=>$this->is_feature,
            "feature_image_url"=>$this->feature_image_url,
            "annotation"=>$this->annotation,
            "in_favorite"=>$this->in_favorite,
        ];
    }
}
