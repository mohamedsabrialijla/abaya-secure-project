<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $products_count
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereStatus($value)
 * @mixin \Eloquent
 */
class Color extends Model
{
    use HasFactory,SoftDeletes,MultiLanguage;
    protected $multi_lang = ['name'];
    protected $table = 'colors';

    public function getNameAttribute(){

        if(app()->getLocale()=='ar')

            return $this->name_ar;

        if(app()->getLocale()=='en')

            return $this->name_en;
    }
    public function getCanDelAttribute()
    {
        $b1=0;
        $b2=$this->products_count;
        return $b1+$b2 == 0 ? true:false;
    }
    public function products(){
        return $this->hasMany(ProductColor::class,'color_id');
    }
}
