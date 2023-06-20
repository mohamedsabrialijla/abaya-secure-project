<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
//        return $this->data;
        return [
            'id'=>$this->id,
            'title'=>@$this->data['title'],
            'message'=>getTranslatedNotificationMessage($this->data),
            'human_date'=>Carbon::parse($this->created_at)->diffForHumans(),
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }
}
