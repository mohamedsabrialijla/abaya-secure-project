<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    use HasFactory;
    protected $fillable=['case_id','order_id'];

    public function case(){
        return $this->belongsTo(OrderCase::class,'case_id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
