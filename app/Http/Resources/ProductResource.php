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
        $store=$this->designer;
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "discount_ratio"=>$this->discount_ratio,
            "details"=>$this->details,
            "main_image"=>$this->image_url,
            "has_discount"=>$this->has_discount,
            "price"=>$this->price,
            "ordering"=>$this->ordering,
            "sale_price"=>$this->sale_price,
            "is_feature"=>$this->is_feature,
            "cod"=>$this->cod,
            "feature_image_url"=>$this->feature_image_url,
            "annotation"=>$this->annotation,
            "in_favorite"=>$this->in_favorite,
            "category"=>CategoryResource::make( $this->category),
            "categories"=>$this->categories,
            "offer"=>$this->coupons()?CouponResource::make( $this->coupons()->first()):null,
            // "offer"=>$this->coupons,
            "designer"=>DesignerResource::make($this->designer),
            "sizes"=>ProductSizeResource::collection($this->productSizes),
//            "colors"=>ProductColorResource::collection($this->colors),
            "images"=>ImageResource::collection($this->images),
            "slider_image_url"=>$this->slider_image_url,
            "related_products"=>RelatedProductResource::collection($this->relatedProducts()->get())

        ];
//        return parent::toArray($request);
    }

//    public function with($request)
//    {
//        return [
//            'meta' => [
//                'key' => 'value',
//            ],
//        ];
//    }

}
