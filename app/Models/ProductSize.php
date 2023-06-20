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
class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_sizes';
    protected $fillable = ['product_id','size_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }

    public function stock(){
        return $this->hasMany(Stock::class,'product_size_id');
    }

    public function qty(){
        return ($this->stock()->where('type','deposit')->sum('qty') - $this->stock()->where('type','withdraw')->sum('qty'));
    }
}
