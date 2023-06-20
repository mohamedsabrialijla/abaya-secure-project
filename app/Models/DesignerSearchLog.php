<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerSearchLog extends Model
{
    use HasFactory;
    protected $table='designer_search_logs';
    protected $fillable=['text','results_count'];
}
