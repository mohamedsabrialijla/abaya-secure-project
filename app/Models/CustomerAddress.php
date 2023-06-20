<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'lat',
        'lng',
        'name',
        'mobile',
        'address',
        'customer_id',
        'type',
        'is_internal',
        'area_id'
    ];
    public function area()
    {
        return $this->belongsTo(Area::class,'area_id')->withDefault(['city_code'=>3]);
    }

}
