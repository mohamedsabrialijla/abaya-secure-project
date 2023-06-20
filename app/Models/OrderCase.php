<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\OrderCase
 *
 * @property int $id
 * @property int $order_id
 * @property int $case_id
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CaseGeneral $case
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderCase whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $text_ar
 * @property string|null $text_en
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereTextAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderCase whereTextEn($value)
 */
class OrderCase extends Model
{
    use SoftDeletes;

    protected $table='order_cases';
    protected $fillable=['name_ar','name_en','hex_color','is_active','details_ar','details_en'];
  //  protected $with=['case'];
    protected $appends=['name','details'];

    public function getNameAttribute(){

        if(app()->getLocale()=='ar'){
           return  $this->name_ar;
        }
        return  $this->name_en;
    }
    public function getDetailsAttribute(){

        if(app()->getLocale()=='ar'){
            return  $this->details_ar;
        }
        return  $this->details_en;
    }
    public function orders(){
        return $this->hasMany(Order::class,'case_id');
    }
    public function key($type)
    {
        return $this->where('name_en', $type)->first();
    }

    public function idOf($type , $default = 0)
    {
        return (isset($this->key($type)->id)) ? $this->key($type)->id : $default;
    }
}
