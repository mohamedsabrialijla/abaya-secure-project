<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable,SoftDeletes;
    protected $fillable=[
        'avatar',
        'name',
        'mobile',
        'email',
        'dial_code',
        'password',
        'email_verified_at',
        'mobile_verified_at',
        'status',
        'activation_code',
        'last_login',
        'fcm_token',
        'promo_code',
        'wallet',
        'ip_address',
        'login_from',

    ];
    protected $appends=['avatar_url','avatar_thumb_url','points_value'];
    public function getAvatarUrlAttribute()
    {
        $logo=isset($this->attributes['avatar'])?$this->attributes['avatar']:'';

        return $logo?asset('uploads/'.$logo):asset('uploads/avatar.png');
    }
    public function getAvatarThumbUrlAttribute()
    {
        $logo=isset($this->attributes['avatar'])?$this->attributes['avatar']:'';

        return $logo?asset('uploads/thumbnail/'.$logo):asset('uploads/thumbnail/avatar.png');
    }
    public function addresses(){
        return $this->hasMany(CustomerAddress::class,'customer_id');
    }
    public function favorites(){
        return $this->hasMany(Favorite::class,'customer_id');
    }
    public function scopeFilter($q, $request){
        if ($request->filled('mobile')) {
            $full_mobile = $request->mobile_code. $request->mobile;
              $q->where('mobile',$full_mobile);
        }
        if($request->filled('email')) {
            $q->where('email',$request->email);
        }

    }
    public function getPointsValueAttribute(){
        if($this->points > 0){
            $settings=new Settings();
            $pointsForSar=$settings->valueOf('points_to_cash_one_sar',0);
           return  $cach=round(($this->points/$pointsForSar),2);
        }
        return 0;
    }
    public function orders(){
        return $this->hasMany(Order::class,'customer_id')->orderBy('created_at', 'desc');
    }
}

