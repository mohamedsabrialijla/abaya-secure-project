<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $created_at = Carbon::parse(@$this->created_at);
        $created_at=$created_at->translatedFormat('D jS M Y g:i a');
        return [
            "id"=>$this->id,
            "status"=>OrderCaseResource::make($this->case),
            "order_id"=>$this->order_id,
            "created_at"=>$created_at,

        ];
    }
}
