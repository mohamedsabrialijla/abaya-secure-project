<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable=['type','product_size_id','order_id','order_product_id','qty','reason'];
    protected $appends=['type_label'];
    public function size(){
        return $this->productSize();
    }
    public function productSize(){
        return $this->belongsTo(ProductSize::class,'product_size_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function orderProduct(){
        return $this->belongsTo(OrderProduct::class,'order_product_id');
    }
    public function getTypeLabelAttribute()
    {
        return [
            "deposit"=>"اضافة",
            "withdraw"=>"سحب",
        ][$this->type];
    }
    public function availableQty(){
        return (($this->where('type','deposit')->sum('qty')) - ($this->where('type','withdraw')->sum('qty')));

    }
}
