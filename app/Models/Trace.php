<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class Trace extends Model{
    protected $table = 'traces';
    
    
    protected $appends=['pay'];
    
    public function getPayAttribute(){
        
    //   return $this->created_at->day();
        $o = Order::where('customer_id',$this->user_id)->first();

        // DB::table('traces')->where('user_id',$o->customer_id)->update(['status'=> $o->is_paid]);
    }


}
