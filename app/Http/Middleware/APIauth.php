<?php
namespace App\Http\Middleware;
use App\Http\Controllers\ControllersService;
use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Str;

class APIauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next,$type='user')
    {
        if($type == 'user'){
            $user=null;
            if ($request->token && $request->user_id) {
                $user = User::find($request->user_id);
            }elseif ($request->headers->get("X-Authorization")){
                $token=Str::after($request->headers->get("X-Authorization"),'Bearer ');
                $user = User::where('token',$token)->first();
            }elseif ($request->headers->get("Authorization")){
                $token=Str::after($request->headers->get("Authorization"),'Bearer ');
                $user = User::where('token',$token)->first();
            }else{
                return ControllersService::generateGeneralResponse(false, 'user_not_found', null, 401);
            }
            if($user){
                if(!$request->user_id){
                    $request->offsetSet('user_id', $user->id);
                }
                if ($user->status == 1) {

                    return $next($request);
                } elseif ($user->status == 0) {
                    return ControllersService::generateArraySuccessResponse(['user_data' => User::find($user->id)], 'user_not_activated', null, 422);
                } else {
                    return ControllersService::generateGeneralResponse(false, 'user_blocked', null, 400);
                }
            }else{
                return ControllersService::generateGeneralResponse(false, 'user_not_found', null, 401);
            }
        }
        return ControllersService::generateGeneralResponse(false, 'user_not_found', null, 400);
    }
}
