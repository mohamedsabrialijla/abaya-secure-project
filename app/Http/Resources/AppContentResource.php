<?php

namespace App\Http\Resources;

use App\Models\Settings;
use App\Models\SplashImage;
use Illuminate\Http\Resources\Json\JsonResource;

class AppContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang=app()->getLocale();
        $settings=new Settings();
//        return parent::toArray($request);
        return [
            'about_us'=>$settings->valueOf('about_us_'.$lang),
            'privacy_and_policy'=>$settings->valueOf('privacy_and_policy_'.$lang),
            'terms_and_conditions'=>$settings->valueOf('terms_and_conditions_'.$lang),
//            'splash_promotion_text'=>$settings->valueOf('splash_promotion_text_'.$lang),
//            'splash_images'=>ImageResource::collection(SplashImage::where('is_active',true)->get()),


        ];
    }
}
