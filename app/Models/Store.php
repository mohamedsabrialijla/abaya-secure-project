<?php

namespace App\Models;

use App\Models\Category;
use App\Traits\MultiLanguage;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Astrotomic\Translatable\Translatable;
use DB;

class Store extends Authenticatable
{
    //
    use SoftDeletes;
    use MultiLanguage;
    protected $multi_lang = ['name','slug'];

    protected $table = 'stores';
    protected $appends = ['image', 'image_thumbnail', 'instagram_username', 'snapchat_username', 'products_count', 'return_policy'];
    public function getNameAttribute()
    {

        if (app()->getLocale() == 'ar')

            return $this->name_ar;
        if (app()->getLocale() == 'en')

            return $this->name_en;
    }


     public function getSlugAttribute(){


        if(app()->getLocale()=='ar')

            return $this->slug_ar;



        if(app()->getLocale()=='en')

            return $this->slug_en;
    }



    public function scopeFilter($builder, $filters = []){

        if(!$filters) {
            return $builder;
        }

        if(app()->getLocale()=='ar'){
            $builder->where('slug_ar',$filters);
        }else{
            $builder->where('slug_en',$filters);
        }
    }

    public function getImageAttribute()
    {
        return $this->logo != null ? asset('uploads/' . $this->logo) : url('uploads/thumbnail/avatar.png');
    }
    public function getImageThumbnailAttribute()
    {
        return $this->logo != null ? asset('uploads/' . $this->logo) : url('uploads/thumbnail/avatar.png');
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'store_id')->where('is_active', true)->orderBy('ordering','asc');
    }


    public function orders()
    {
        return $this->hasMany(OrderProduct::class, 'store_id');
    }

    public function getProductsCountAttribute()
    {
        $products = $this->products();
        if ($category_id = request()->category_id)
            $products->where('category_id', $category_id);

        return $products->count();
    }

    public function getCanDelAttribute()
    {
        $r1 = $this->products()->count();

        return $r1 + 0 == 0;
    }


    public function getInstagramUsernameAttribute()
    {
        if (isset($this->attributes['instagram'])) {
            $old = $this->attributes['instagram'];
            if (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:instagram\.com|instagr\.am)\/([A-Za-z0-9-_\.]+)/im', $old)) {
                $trimed = trim($old);
                $trimed = trim($trimed, '/');
                $arr = explode('/', $trimed);
                if (isset($arr[(count($arr) - 1)])) {
                    return $arr[(count($arr) - 1)];
                }
            }
            return $old;
        }
        return '';
    }
    public function getSnapchatUsernameAttribute()
    {
        if (isset($this->attributes['snapchat'])) {
            $old = $this->attributes['snapchat'];
            $trimed = trim($old);
            $trimed = trim($trimed, '/');
            $arr = explode('/', $trimed);
            if (isset($arr[(count($arr) - 1)])) {
                return $arr[(count($arr) - 1)];
            }

            return $old;
        }
        return '';
    }
    public function scopeSearch($q, $request)
    {
        $locale = app()->getLocale();

        //filter products by name
        if ($request->filled('name')) {
            if ($locale == "ar") {
                $q->where('name_ar', 'LIKE', '%' . $request->name . '%');
            } else {

                $q->where('name_en', 'LIKE', '%' . $request->name . '%');
            }
        }
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }

    public function activeCoupon()
    {
        return Coupon::query()->AbleToUse($this->id);
        //        $dateNow=Carbon::now();
        //        $condition = "(SELECT COUNT(id) FROM  order_products  WHERE order_products.coupon_id=coupons.id)";
        //        return Coupon::select(DB::raw("*, $condition AS number_of_use"))->where('store_id',$this->id)
        //            ->whereRaw("count_of_use > $condition ")->where('is_active','=',1)->where('start_date','<=',$dateNow)->where('expire_date','>=',$dateNow)->orderBy('created_at','desc');
        //
    }

    public function getReturnPolicyAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->return_policy_ar;
        }
        return $this->return_policy_en;
    }
}
