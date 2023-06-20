<?php

namespace App\Http\Controllers;


use App\Models\Area;
use App\Models\Gov;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_areas|add_areas|edit_areas|delete_areas,system_admin', ['only' => ['index', 'create']]);
        $this->middleware('permission:add_areas,system_admin', ['only' => ['create', 'showCreateView', 'addNewSize']]);
        $this->middleware('permission:edit_areas,system_admin', ['only' => ['showUpdateView', 'update']]);
        $this->middleware('permission:delete_areas,system_admin', ['only' => ['delete']]);
    }

    public function index(Request $request)
    {
        $o = Area::orderBy('id', 'DESC');
        if ($request->name) {
            $o->where('name_en', 'like', '%' . $request->name . '%')
                ->orWhere('name_ar', 'like', '%' . $request->name . '%');
        }

        if ($request->gov_id) {
            $o->where('gov_id', $request->gov_id);
        }

        $govs = Gov::query()->get();

        $out = $o->paginate(20);

        return view('system_admin.area_new.index', compact('out', 'govs'));
    }


    public function showCreateView()
    {
        $govs = Gov::query()->get();

        return view('system_admin.area_new.create',compact('govs'));

    }

    public function create(Request $request)
    {

        $this->validate($request,
            [
                'name_ar' => ['required', 'max:30',
                    Rule::unique('govs', 'name_ar')->whereNull('deleted_at')
                ],
                'name_en' => ['required', 'max:30',
                    Rule::unique('govs', 'name_en')->whereNull('deleted_at')
                ],
                'gov_id' => 'required|exists:govs,id'
            ]);

        $out = new Area();
        $out->name_ar = $request->name_ar;
        $out->name_en = $request->name_en;
        $out->gov_id = $request->gov_id;
        $out->is_cash = $request->is_cash ? 1 : 0;
        $out->save();

        flash('تم  الاضافة بنجاح');

        return redirect()->route('system.areas.index');

    }


    public function showUpdateView(Request $request)
    {
        $govs = Gov::query()->get();

        $out = Area::find($request->id);
        return view('system_admin.area_new.update', compact('out','govs'));

    }

    public function Update(Request $request, $id)
    {
        $out = Area::find($id);

        $this->validate($request, [
            'name_ar' => ['required', 'max:30',
                Rule::unique('govs', 'name_ar')->ignore($id)->whereNull('deleted_at')
            ],
            'name_en' => ['required', 'max:30',
                Rule::unique('govs', 'name_en')->ignore($id)->whereNull('deleted_at')
            ],
            'gov_id' => 'required|exists:govs,id'
        ]);

        $out->name_ar = $request->name_ar;
        $out->name_en = $request->name_en;
        $out->gov_id = $request->gov_id;
        $out->is_cash = $request->is_cash ? 1 : 0;
        $out->save();

        flash('تم التعديل بنجاح');

        return redirect()->route('system.areas.index',['gov_id'=>$request->gov_id]);
    }


    public function delete(Request $request)
    {
        $ids = [];
        if (is_array($request->id)) {
            $ids = $request->id;
        } else {
            $ids[] = $request->id;
        }
        foreach ($ids as $id) {
            $c = Area::find($id);
            $c->delete();

        }
        return ['done' => 1];

    }


}
