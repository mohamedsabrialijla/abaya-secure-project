<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'offer_products');
    }

    public function getImageUrlAttribute()
    {
        $im = $this->image;
        return $im ?  asset('uploads/'.$im) : null;
    }
}
