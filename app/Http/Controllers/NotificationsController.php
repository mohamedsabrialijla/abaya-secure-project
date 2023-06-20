<?php

namespace App\Http\Controllers;

use App\Events\SendUserNotification;
use App\Events\SendUsersNotification;
use App\Models\Customer;
use App\Models\GlobalNotification;
use App\Models\Order;
use App\Models\Product;

use App\Models\UserNotification;
use App\SystemAdmin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotificationsController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:activate_notifications|view_notifications|add_notifications|edit_notifications|delete_notifications,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_notifications,system_admin', ['only' => ['create','showCreateView']]);
        $this->middleware('permission:edit_notifications,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_notifications,system_admin', ['only' => ['delete']]);
    }

    public function notifications(Request $request)
    {

        $o=GlobalNotification::query()->orderBy('id','DESC');

        if ($request->name) {
             $o->where('title', 'like', '%' . $request->name . '%');;
        }
        if($request->date_from){
            $date_from = Carbon::parse($request->date_from)->toDateString();
            $o->whereDate('created_at','>=',$date_from);
        }
        if($request->date_to){
            $date_to = Carbon::parse($request->date_to)->toDateString();
            $o->whereDate('created_at','<=',$date_to);
        }
        $out=$o->paginate(20);

        return view('system_admin.notifications.index', compact('out'));

    }

    /***********************************/
    public function showCreateView()
    {

        $users=Customer::all();
      return view('system_admin.notifications.create',compact('users'));


    }


    /*************************/

    public function create(Request $request)
    {


    $this->validate($request, [
          'title_with_imoje' => 'required|max:255',
          'message_with_imoje' => 'required',
      ]);
        $title=$request->get('title_with_imoje');
        $message=$request->get('message_with_imoje');
        $name = $request->get('name');
        $notification = new GlobalNotification();
        $notification->title = $title;
        $notification->message = $message;
        $notification->system_admin_id = Auth::guard('system_admin')->user()->id;
        $notification->save();
        $notification->fresh();
        $message=[
            'title'=>$title,
            'msg'=>$message,
            'name'=>$name,
        ];
        switch ($request->user_query){
            case 0:
                     event(new SendUsersNotification(null,$message));
                break;
            case 1:
                     $customers=Customer::where('status',0)->get();
                     event(new SendUsersNotification($customers,$message));
                break;
            case 2:
                    $customers=Customer::whereDoesntHave('orders')->get();
                    event(new SendUsersNotification($customers,$message));
                break;
            case 3:
                    $customers=Customer::whereIn('id',$request->user_ids)->get();
                    event(new SendUsersNotification($customers,$message));
                break;
        }

        flash('تم الارسال بنجاح');

    return redirect()->route('system.notifications.index');
    }

    public function delete(Request $request)
    {
        if(is_array($request->id)){
            foreach ($request->id as $id) {
                $o=GlobalNotification::find($id);

                $this->deleteNotifications($id);
                $o->delete();

            }
            return ['done'=>1];

        }else{
            $o=GlobalNotification::find($request->id);
            $this->deleteNotifications($request->id);
            $o->delete();
            return ['done'=>1];
        }
    }
    public function deleteNotifications($id){
                 UserNotification::query()
                ->where('global_id',$id)
                ->delete();
                 return true;
    }


}
