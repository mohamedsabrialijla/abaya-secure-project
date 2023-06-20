<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $dateFormat = 'Y-m-d';
    protected $table = 'coupons';
    /*  protected $casts = [
        'start_date' => 'date:Y-m-d',
        'expire_date' => 'date:Y-m-d',
    ];*/
    protected $dates = ['start_date', 'expire_date'];
    protected $appends = ['used_count'];
    public function designer()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    protected function serializeDate(\DateTimeInterface  $date)
    {
        return $date->format('Y-m-d');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')->where('case_id', '!=', 2)->distinct();

    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_products');
    }
    public function getUsedCountAttribute()
    {
        return $this->hasMany(OrderProduct::class, 'coupon_id')->whereHas('order', function ($q) {
            $q->where('case_id', '!=', 2);
        })->count();
    }
    public function scopeAbleToUse($q, $store = null)
    {
        $dateNow = Carbon::now();
        $activeCoupon = $q->where('count_of_use', '>', $this->getUsedCountAttribute())->where('start_date', '<=', $dateNow)->where('expire_date', '>=', $dateNow)->where('is_active', true);

        return $activeCoupon;
    }
    public function scopeActive()
    {
        $dateNow = Carbon::now();
        return $this->where('start_date', '<=', $dateNow)->where('expire_date', '>=', $dateNow)->where('is_active', true);
    }
    public function scopeShow()
    {
        return $this->where('show',1);
    }
}
