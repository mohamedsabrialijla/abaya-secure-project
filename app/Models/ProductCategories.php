<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductSize
 *
 * @property int $id
 * @property int $product_id
 * @property int $size_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereSizeId($value)
 * @mixin \Eloquent
 */
class ProductCategories extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $fillable = ['product_id','category_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

 
     public function categories(){
        return $this->hasMany(ProductCategories::class,'caategory_id');
    }

    public function stock(){
        return $this->hasMany(Stock::class,'product_category_id');
    }

    public function qty(){
        return ($this->stock()->where('type','deposit')->sum('qty') - $this->stock()->where('type','withdraw')->sum('qty'));
    }
}
