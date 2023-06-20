<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductStyle extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'product_style';
    protected $fillable = ['product_id','style_id'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function style(){
        return $this->belongsTo(Style::class,'style_id');
    }
}
