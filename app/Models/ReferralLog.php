<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLog extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'reference_customer__id',
        'promo_code',
        'status',
        'reference_customer_points',
        'reference_customer_wallet',

    ];
}
