<?php
namespace App\Models;
use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int $status
 * @property string $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $can_del
 * @property-read mixed $image_thumbnail
 * @property-read mixed $image_url
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 */
class Category extends Model{

    use HasFactory,MultiLanguage;

    protected $table = 'categories';
    protected $hidden=['created_at','updated_at','deleted_at','status'];
    protected $appends=['image_url','product_selected'];
    protected $multi_lang = ['name'];
    protected $guarded = [];

    public function getNameAttribute(){


        if(app()->getLocale()=='ar')

            return $this->name_ar;



        if(app()->getLocale()=='en')

            return $this->name_en;
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id')->where('is_active', true)->orderBy('ordering','asc');
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
