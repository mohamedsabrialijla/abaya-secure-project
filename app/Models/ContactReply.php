<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property int $contact_id
 * @property string $reply
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactReply whereContactId($value)
 * @mixin \Eloquent
 */
class ContactReply extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='contact_replies';
//    protected $hidden=['created_at','updated_at'];
    protected $fillable=["contact_id","reply"];

    protected $casts = [
        'created_at'     => 'datetime:Y-m-d',
    ];

    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}
