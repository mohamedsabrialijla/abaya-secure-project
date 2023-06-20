<?php

namespace App\Http\Controllers;


use App\Models\Module;
use App\Models\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:activate_roles|view_roles|add_roles|edit_roles|delete_roles,system_admin', ['only' => ['index','create']]);
        $this->middleware('permission:add_roles,system_admin', ['only' => ['create','showCreateView']]);
        $this->middleware('permission:edit_roles,system_admin', ['only' => ['showUpdateView','update']]);
        $this->middleware('permission:delete_roles,system_admin', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $o = Role::orderBy('id', 'DESC');
        $out = $o->paginate(20);
        return view('system_admin.roles.index', compact('out'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateView()
    {

        $permission = Permission::get();

        return view('system_admin.roles.create', compact( 'permission'));
    }


    public function create(Request $request){

      //  return $request;
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name'=>'system_admin'
        ]);

        $role->syncPermissions([$request->input('permission')]);

        flash('تم  الاضافة بنجاح');
        return redirect(route('system.roles.index'));
    }

    public function showUpdateView($id)
    {
        $out = Role::find($id);

        $permission = Permission::get();


        return view('system_admin.roles.update', compact('out', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
       // return $request;
        $role  = Role::findOrfail($id);
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id,
            'permission' => 'required',
        ]);

        $role->update([
            'name' => $request->input('name'),
            'guard_name'=>'system_admin'
        ]);

        $role->syncPermissions($request->input('permission'));

        flash('تم التعديل بنجاح');

        return redirect()->route('system.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $ids=[];
        if(is_array($request->id)){
            $ids=$request->id;
        }else{
            $ids[]=$request->id;
        }
        foreach ($ids as $id){
            $c=Role::find($id);
                $c->delete();
        }
        return ['done'=>1];
    }
}
