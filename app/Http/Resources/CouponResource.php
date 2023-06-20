<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            "start_date"=>$this->start_date,
            "expire_date"=>$this->expire_date,
            "count_of_use"=>$this->count_of_use,
            "flag"=>$this->flag,
            "discount_ratio"=>$this->discount_ratio,
            "limit"=>$this->limit,
            "show"=>$this->show,
            "code"=>$this->code
        ];
    }
}
