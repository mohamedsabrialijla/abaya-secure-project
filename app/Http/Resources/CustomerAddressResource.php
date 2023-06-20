<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'mobile'=>$this->mobile,
            'address'=>$this->address,
            'type'=>trans('api_texts.address_type.'.$this->type),
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'is_internal'=>$this->is_internal,
            'area'=>$this->area,
        ];
    }
}
