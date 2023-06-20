<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\ProductProperty
 *
 * @property int $id
 * @property int $product_id
 * @property int $property_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Property $property
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductProperty wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereValueAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereValueEn($value)
 * @mixin \Eloquent
 */
class ProductProperty extends Model
{
    use HasFactory,SoftDeletes,MultiLanguage;
    protected $multi_lang = ['value'];
    protected $table = 'product_properties';

}
