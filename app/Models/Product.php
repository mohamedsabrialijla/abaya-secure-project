<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Product extends Model
{
    //
    use SoftDeletes,MultiLanguage,HasFactory;
    protected $multi_lang = ['name', 'details'];

    protected $table = 'products';
    protected $appends = ['image','image_url','has_discount', 'in_favorite','annotation','feature_image_url','slider_image_url'];
    protected $fillable=['ordering'];
    protected $with=['def_image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    //  public function category()
    // {
    //     return $this->belongsToMany(\App\Models\Category::class, 'product_categories', 'product_id', 'category_id');
    // }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function designer()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'product_properties');
    }


    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'content');
    }

//    public function getPriceAttribute()
//    {
//
//        if ($this->attributes['discount_ratio'] > 0) {
//            $price = $this->attributes['price'] - (($this->attributes['price'] * ($this->attributes['discount_ratio'] / 100)));
//        } else {
//            $price = $this->attributes['price'];
//        }
//
////        if (session('country_id')) {
////            if ($cc = Country::find(session('country_id'))) {
////                $price = $price * $cc->conversion_factor;
////            }
////        }
//
//        return round($price, 3);
//
//
//    }



//    public function getRealPriceAttribute()
//    {
//        $price = $this->attributes['price'];
//        return $price;
//    }


    public function getHasDiscountAttribute()
    {
        if ($this->attributes['discount_ratio'] > 0) {
           return true ;
        }
        return false;
    }






    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function def_image()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->where('is_main',1);
    }


    public function getImageAttribute()
    {
        $im = $this->def_image;
        return $im ? $im->image : 'logo.png';
    }

    public function getImageUrlAttribute()
    {
        $im = $this->def_image;
        return $im ? $im->image_url : asset('uploads/logo.png');
    }
    public function getFeatureImageUrlAttribute()
    {
        $im = $this->feature_image;
        return $im ?  asset('uploads/'.$im) : null;
    }
    public function getSliderImageUrlAttribute()
    {
        $im = $this->slider_image;
        return $im ?  asset('uploads/'.$im) : null;
    }


    public function orders()
    {
        return $this->hasMany(OrderProduct::class,'product_id');
    }

    public function getCanDelAttribute()
    {
        $r1=$this->orders_count;
        $r2=0;
        return $r1+$r2 ==0;

    }
    public function favorite()
    {
        return $this->morphMany(Favorite::class, 'content');
    }

    public function getInFavoriteAttribute()
    {
       $customer= auth('customer')->user();
        if ($customer) {
            $user_id = $customer->id;
            if ($this->favorite()->where('customer_id', $user_id)->first()) {
                return true;
            }
        }
        return false;
    }


    public function scopeSearch($q,$request)
    {

            //filter products by name
        if ($request->filled('name')) {
            $q->where(function($qq) use($request){
                $qq->where('name_ar','LIKE','%'.$request->name.'%')
                    ->orWhere('name_en','LIKE','%'.$request->name.'%')
                    ->orWhere('details_ar','LIKE','%'.$request->name.'%')
                    ->orWhere('details_en','LIKE','%'.$request->name.'%');
            });

//            $q->whereTranslationLike('name', "%{$request->q}%");
        }
            //filter products by sizes
        if ($request->filled('sizes_list') && !empty(json_decode($request->sizes_list))) {
            $q->whereHas('sizes',function($qq) use($request){
                return $qq->whereIn('size_id',json_decode($request->sizes_list));
            });
        }

        //filter products by colors

        if ($request->filled('colors_list') && !empty(json_decode($request->colors_list))) {
            $q->whereHas('colors',function($qq) use($request){
                return $qq->whereIn('color_id',json_decode($request->colors_list));
            });
        }
        //filter products by categories list
        if ($request->filled('categories_list') &&  !empty(json_decode($request->categories_list))) {
            $q->whereIn('category_id',json_decode($request->categories_list));
        }
        //filter products by category_id

        if ($request->filled('category_id') && $request->category_id) {
            $q->where('category_id',$request->category_id);
        }
        //filter products by designer id
      if ($request->filled('designer_id') && $request->designer_id) {
            $q->where('store_id',$request->designer_id);
        }

        //filter products by price
        if ($request->filled('min_price')  && $request->filled('max_price') ) {
            $q->where('price', '>=', $request->min_price)->where('price','<=',$request->max_price);
        }
        // Sort products product
        if ($request->filled('sort_by') && $request->sort_by) {
            switch ($request->sort_by){
                case 'new':
                    $q->orderBy('created_at','desc');
                    break;
                case 'low_price':
                    $q->orderBy('sale_price','asc');
                    break;
                case 'high_price':
                    $q->orderBy('sale_price','desc');
                    break;
            }
        }
    }

    public function relatedProducts(){
        return Product::whereNotIn('id',[$this->id])->where('category_id',$this->category_id)->where('is_active',1)->inRandomOrder()->take(5);
    }
    public function sizes()
    {
        return $this->belongsToMany(\App\Models\Size::class, 'product_sizes', 'product_id', 'size_id');
    }

    public function productSizes(){
        return $this->hasMany(ProductSize::class,'product_id');
    }
    public function colors()
    {
        return $this->belongsToMany(\App\Models\Color::class, 'product_colors', 'product_id', 'color_id');
    }
    
    
    public function clothes()
    {
        return $this->belongsToMany(\App\Models\Clothes::class, 'product_clothes', 'product_id', 'clothes_id');
    }
    
    
    public function style()
    {
        return $this->belongsToMany(\App\Models\Style::class, 'product_style', 'product_id', 'style_id');
    }

    public function getAnnotationAttribute(){
        $lang=app()->getLocale();
        if($lang =="ar"){
            return $this->annotation_ar;
        }
        return $this->annotation_en;
    }


    public function coupons()
    {
        $dateNow = Carbon::now();
        return $this->belongsToMany(Coupon::class, 'coupon_products')->where('start_date', '<=', $dateNow)->where('expire_date', '>=', $dateNow)->where('is_active', true);
    }

}
