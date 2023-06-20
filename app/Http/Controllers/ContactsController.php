<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsReplay;
use App\Models\Contact;
use App\Models\ContactReply;
use App\Models\GlobalNotification;
use App\Models\UserAddress;
use App\Models\UserNotification;
use App\SystemAdmin;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_contacts|view_contacts|add_contacts|edit_contacts|delete_contacts,system_admin', ['only' => ['index','contactReplay']]);
        $this->middleware('permission:edit_contacts,system_admin', ['only' => ['index','contactReplay']]);
        $this->middleware('permission:delete_contacts,system_admin', ['only' => ['delete']]);
    }

    public function index()
    {

        $out=Contact::orderBy('id','DESC')->paginate(20);
        return view('system_admin.contacts.index', compact('out'));

    }


    public function contactReplay(Request $request)
    {

        $this->validate($request,[
            'email' => 'required',
            'mess' => 'required',
        ]);
        $email=$request->email;
        $mess=$request->mess;

        Mail::to($email)->send(new ContactUsReplay($mess));
        $contact=Contact::find($request->id);
        if($user = User::find($contact->user_id)){
            ControllersService::NotificationToUser($user->id,'رد على استفسار','تم الرد على استفساركم',0);
        }

        $contact_reply = new ContactReply();
        $contact_reply->contact_id = $request->id;
        $contact_reply->reply = $request->mess;
        $contact_reply->save();

        flash('تم الارسال بنجاح');
        return back();
    }

    public function getContactReplies($id){

        $replies= ContactReply::orderBy('id','DESC')->where("contact_id",$id)->get();
       // $replies_list=view('system_admin.contacts.replies',$replies)->render();
        return response()->json($replies);
    }



    public function delete(Request $request)
    {
        if(is_array($request->id)){
            foreach ($request->id as $id) {
                $o=Contact::find($id);
                $o->delete();

            }
            return ['done'=>1];

        }else{
//            $this->validate($request, Order::$getRoles);
            $o=Contact::find($request->id);
            $o->delete();
            return ['done'=>1];
        }
    }









}
