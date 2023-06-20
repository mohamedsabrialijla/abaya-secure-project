<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductClothes extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'product_clothes';
    protected $fillable = ['product_id','clothes_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function clothes(){
        return $this->belongsTo(Clothes::class,'clothes_id');
    }
}
