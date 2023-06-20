<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            "qty"=>$this->qty,
            "price"=>$this->price,
            "is_returned"=>$this->is_returned,
            "discount_ratio"=>$this->discount_ratio,
            "discount"=>$this->discount,
            "total"=>$this->total,
            "order_id"=>$this->order_id,
            "size"=>$this->size,
            "color"=>@$this->color,
            "store"=>DesignerResource::make($this->designer),
            "product"=>ProductResource::make($this->product),
            "coupon_id"=>CouponResource::make($this->coupon),
        ];
    }
}
