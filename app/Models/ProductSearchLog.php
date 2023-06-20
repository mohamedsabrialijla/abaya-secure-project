<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSearchLog extends Model
{
    use HasFactory;
    protected $fillable=['text','results_count'];
}
