<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $qty
 * @property float $item_price
 * @property float $price
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereItemPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereQty($value)
 * @mixin \Eloquent
 */
class OrderProduct extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'store_id',
        'order_id',
        'product_id',
        'coupon_id',
        'qty',
        'price',
        'discount_ratio',
        'discount',
        'total',
        'size_id',
        'color_id',
        'is_returned',
        'total_before_discount',
    ];
    protected $table='order_products';
    public $timestamps=false;

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    
      public function order2()
    {
        return $this->belongsTo(Order::class,'order_id')->where('case_id',2);
    }
    public function designer()
    {
        return $this->belongsTo(Store::class,'store_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id')->withTrashed();
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class,'color_id')->withDefault();
    }
}
