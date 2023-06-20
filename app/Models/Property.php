<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $products_count
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Property whereStatus($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
    use HasFactory,SoftDeletes,MultiLanguage;
    protected $multi_lang = ['name'];
    protected $table = 'properties';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_properties');
    }

    public function getCanDelAttribute()
    {
        $b1=0;
        $b2=$this->products_count;
        return $b1+$b2 == 0 ? true:false;
    }
}
