<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\PaymentType
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $icon
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentType whereNameEn($value)
 * @mixin \Eloquent
 */
class PaymentType extends Model
{
    use MultiLanguage;
    protected $multi_lang = ['name'];
    protected $table='payment_types';
    protected $appends=['icon_url'];

    public function getIconUrlAttribute(){
        return $this->icon?asset('uploads/'.$this->icon):"";
    }

}
