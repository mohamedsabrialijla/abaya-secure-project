<?php
namespace App\Models;
use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $image
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $can_del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $prefix
 * @property int|null $mobile_digits
 * @property string|null $currency_ar
 * @property string|null $currency_en
 * @property string|null $flag
 * @property int|null $is_default
 * @property int|null $check_start_digit
 * @property int|null $start_digit
 * @property int|null $accept_prefix
 * @property-read mixed $flag_url
 * @property-read mixed $trainers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereAcceptPrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCheckStartDigit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCurrencyEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereMobileDigits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereStartDigit($value)
 */
class Country extends Model{
    protected $table = 'countries';
    protected $hidden=['created_at','updated_at'];
    use MultiLanguage;
    protected $multi_lang = ['name','currency'];
    protected $appends=['flag_url'];





//    public function getCanDelAttribute()
//    {
//        $b1=$this->users()->count();
//        $b2=$this->trainers()->count();
//        return $b1+$b2 == 0 ? true:false;
//    }
    use HasFactory;
    protected $fillable=[
        'id',
        'code',
        'name_ar',
        'name_en',
        'phone',
        'mobile_digits',
        'currency_ar',
        'currency_en',
        'flag',
        'iso3',
        'iso_numeric',
        'fips',
        'continent_code',
        'tld',
        'currency_code',
        'languages',
        'time_zone',
        'is_default',

    ];
    public function getFlagUrlAttribute()
    {

        return url('uploads/'.$this->flag);
    }

    public static function getPhonePrefix(){
        return Country::where('is_default',true)->first()['phone']??966;
    }
    public function mobileDigits($phone=null){
        if($phone)
        return Country::where('phone',$phone)->first()['mobile_digits']??9;
    }

}
