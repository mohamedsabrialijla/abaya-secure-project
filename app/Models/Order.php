<?php
namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $mobile
 * @property float $total_price
 * @property int $case_id
 * @property string|null $cancel_reson
 * @property int $address_id
 * @property int $tax_ratio
 * @property float $tax_price
 * @property int $payment_type
 * @property int $transaction_id
 * @property int $is_paid
 * @property float $products_price
 * @property float $delivery_price
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserAddress $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBalance[] $balances
 * @property-read int|null $balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderCase[] $cases
 * @property-read int|null $cases_count
 * @property-read mixed $created_text
 * @property-read mixed $nameid
 * @property-read \App\Models\PaymentType $paymentType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\OrderCase $status
 * @property-read \App\Models\Transaction $transaction
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order accepted()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order canceled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order done()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order new()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order notPaid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order onDelivery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCancelReson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeliveryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereProductsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTaxPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTaxRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Eloquent{
    use \Illuminate\Database\Eloquent\SoftDeletes;
 
    protected $table = 'orders';
    protected $dates = ['deleted_at'];
    protected $appends=['created_text','name','invoice_url','products_count','first_product_name'];
    protected $hidden=['updated_at','deleted_at'];
    protected $fillable=[
        'customer_id',
        'address_id',
        'transaction_id',
        'is_paid',
        'payment_type',
        'invoice_number',
        'sub_total_1',
        'discount',
        'sub_total_2',
        'tax',
        'delivery_cost',
        'total',
        'mobile',
        'tax_ratio',
        'case_id',
        'cancel_reason',
        'bill_file_name',
        'payment_type_id',
        'use_wallet',
        'wallet_amount',
        'app_commission_ratio',
        'app_commission',
        'promo_code',
        'referral_customer_id',
        'discount_ratio',
        'shipment_id',
        'cod_amount',
        'tabby',
        'tamara',
        'reference_number',
        'order_from',
    ];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isPaid', function (Builder $builder) {
            $builder->where('case_id','>',0);
        });
    }
    public function scopeNotPaid($query)
    {
        return $query->where('status_id',1);
    }
    public function scopeNew($query)
    {
        return $query->where('status_id',2);
    }
    public function scopeAccepted($query)
    {
        return $query->where('case_id',3);
    }
    public function scopeOnDelivery($query)
    {
        return $query->where('case_id',4);
    }
    public function scopeDone($query)
    {
        return $query->where('case_id',5);
    }

    public function scopeCanceled($query)
    {
        return $query->where('case_id',6);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'order_id')->latest();
    }


    public function status()
    {
        return $this->belongsTo(OrderCase::class,'case_id')->withTrashed();
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class,'address_id')->withDefault();
    }
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class,'payment_type_id');
    }
    public function getInvoiceUrlAttribute(){
        if($this->bill_file_name){
            return asset('invoices/'.$this->bill_file_name);
        }
        return null;
    }



    public function products(){
        return $this->hasMany(OrderProduct::class,'order_id');
    }
//    public function balances(){
//        return $this->hasMany(UserBalance::class,'order_id');
//    }

    public function getCreatedTextAttribute()
    {
        $old=$this->attributes['created_at'];
        $locale=app()->getLocale();
        return Carbon::parse($old)->locale($locale)->diffForHumans();
    }

    public function getNameAttribute()
    {
        $locale=app()->getLocale();
        if($locale=='ar'){

        return "طلب رقم #".$this->invoice_number;
        }
        return "Order #".$this->invoice_number;
    }

    public function getProductsCountAttribute(){
        return $this->products()->count();
    }

    public function getFirstProductNameAttribute(){
        if($this->products()->count() ==1){
            $orderProduct= $this->products()->first();
            return $orderProduct->product->name;
        }
        return null;
    }
    public function statusLog(){
        return $this->hasMany(OrderStatusLog::class,'order_id');
    }
}
