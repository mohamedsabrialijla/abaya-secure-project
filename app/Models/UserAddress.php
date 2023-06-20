<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property int $gov_id
 * @property int $area_id
 * @property string $block
 * @property string|null $street
 * @property string|null $sub_street
 * @property string|null $build_or_house
 * @property string|null $home_number
 * @property string $build_number
 * @property string|null $floor
 * @property string|null $flat
 * @property string|null $full_address
 * @property float|null $lat
 * @property float|null $lng
 * @property int $saved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Area $area
 * @property-read mixed $address_text
 * @property-read \App\Models\Gov $gov
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereBuildNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereBuildOrHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereFullAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereGovId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereHomeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereSaved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereSubStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAddress whereUserId($value)
 * @mixin \Eloquent
 * @property string $address_name
 * @property string|null $notes
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereNotes($value)
 */
class UserAddress extends Model
{
    protected $table='users_addresses';
    protected $with=['area'];
    protected $appends=['address_text'];
    protected $hidden=['created_at','updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
    public function gov()
    {
        return $this->belongsTo(Gov::class,'gov_id')->withDefault();
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'area_id')->withDefault(['city_code'=>3]);
    }

    public function getAddressTextAttribute()
    {

        $text=$this->gov->name." ، مدينة  ".$this->area->name;
        if($this->block){
            $text.=" ، حي ".$this->block;
        }
        if($this->street){
            $text.=" ، شارع ".$this->street;
        }
        if($this->sub_street){
            $text.=" ، شارع فرعي ".$this->sub_street;
        }
        if($this->build_or_house == 'build'){
            if($this->build_number){
                $text.=' ، '.'رقم بناية'.$this->build_number;
            }
            if($this->floor){
                $text.=' ، '.'رقم طابق'.$this->floor;
            }
            if($this->flat){
                $text.=' ، '.'رقم شقة'.$this->flat;
            }
        }else{
            if($this->build_number){
                $text.=' ، '.'رقم منزل'.$this->build_number;
            }
        }



        return $text;
    }


}
