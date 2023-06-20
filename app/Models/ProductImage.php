<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property int $is_main
 * @property-read mixed $image_thumbnail
 * @property-read mixed $image_url
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereIsMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereProductId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ImageType $typeOB
 */
class ProductImage extends Model
{
    use HasFactory;
    //
    protected $table = 'product_images';
    public $timestamps=false;
    protected $appends=['image_url'];


    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function typeOB(){
        return $this->belongsTo(ImageType::class,'type');
    }
    public function getImageUrlAttribute()
    {
        $logo=$this->attributes['image'];

        return $logo?asset('uploads/'.$logo):asset('uploads/logo.png');
    }

}
