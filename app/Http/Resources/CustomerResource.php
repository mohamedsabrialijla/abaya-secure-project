<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
//            "reg_no"=>$this->reg_no,
//            "avatar_url"=>$this->avatar_url,
//            "address"=>$this->address,
            "mobile"=>$this->mobile,
            "email"=>$this->email,
            "status"=>$this->status??0,
            "token"=>$this->accessToken,
            "avatar_url"=>$this->avatar_url,
            "avatar_thumb_url"=>$this->avatar_thumb_url,
            "activation_code"=>(int)$this->activation_code,
            "promo_code"=>$this->promo_code,
            "points"=>$this->points??0,
            "points_value"=>$this->points_value,
            "wallet"=>$this->wallet??0,
            "addresses"=>CustomerAddressResource::collection($this->addresses),

        ];
//        return parent::toArray($request);
    }
}
