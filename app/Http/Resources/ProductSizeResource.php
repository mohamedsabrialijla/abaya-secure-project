<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSizeResource extends JsonResource
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
            "size_id"=>$this->size_id,
            "size"=>@$this->size->name,
            "qty"=>@$this->qty(),
        ];
//        return parent::toArray($request);
    }
}
