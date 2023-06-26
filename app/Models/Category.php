<?php
namespace App\Models;
use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Category extends Model{

    use HasFactory,MultiLanguage;

    protected $table = 'categories';
    protected $hidden=['created_at','updated_at','deleted_at','status'];
    protected $appends=['image_url','product_selected'];
    protected $multi_lang = ['name','slug'];
    protected $guarded = [];

    public function getNameAttribute(){


        if(app()->getLocale()=='ar')

            return $this->name_ar;



        if(app()->getLocale()=='en')

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




    public function products()
    {
        return $this->hasMany(ProductCategories::class,'category_id')->whereHas('product', function($q){
                $q->where('ordering', 'asc')->where('is_active', true);
            });

    }

    


    


    public function scopeSearch($q,$request)
    {
        $locale=app()->getLocale();

        //filter products by name
        if ($request->filled('name')) {
            if($locale =="ar"){
                $q->where('name_ar', 'LIKE', '%' . $request->name . '%');
            }else{
                $q->where('name_en', 'LIKE', '%' . $request->name . '%');
            }


        }
    }

    public function getCanDelAttribute()
    {
        $b1=0;
        $b2=$this->products_count;
        return $b1+$b2 == 0 ? true:false;
    }


    public function getImageUrlAttribute()
    {
        $logo=$this->attributes['logo']??'';

        return $logo?asset('uploads/'.$logo):asset('uploads/avatar.png');
    }


    public function getProductSelectedAttribute()
    {

        return Product::where('category_id',$this->id)->pluck('id')->toArray();
    }

}
