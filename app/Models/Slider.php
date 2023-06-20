<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'slider_products');
    }

    public function getImageUrlAttribute()
    {
        $im = $this->image;
        return $im ?  asset('uploads/'.$im) : null;
    }
}
