@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.roles.index'),'title'=>'الصلاحيات']
        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'الصلاحيات',
'Disinfo'=>'ادارة الصلاحيات',
'add_url'=>'system.roles.create',
'module'=>'roles',
'actions'=>[
[
            'route'=>'system.roles.delete',
            'icon'=>config('layout.icons.delete_icon'),
            'text'=>'حذف',
            'role'=>"delete",
        ]
]
])
        <div class="row">

            <div class="col-lg-12">


                @if(isset($out) && count($out) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>


                                <th>#</th>
                                <th width="5%" style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                        <input type="checkbox" id="SelectAll">
                                        <span></span>
                                    </label>

                                </th>
                                <th class="text-center">اسم الصلاحية</th>

                                <th class="text-center">الاعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($out as $o)
                                <tr id="TR_{{$o->id}}">

                                    <td class="LOOPIDS">{{($out ->currentpage()-1) * $out ->perpage() + $loop->iteration}}</td>
                                    <td style="text-align: center;vertical-align: middle;">
                                        <label
                                            class="checkbox checkbox-outline checkbox-success justify-content-center">
                                            <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                   class="CheckedItem"
                                                   id="che_{{$o->id}}">
                                            <span></span>
                                        </label>
                                    </td>

                                    <td class="text-center">
                                        <p>{{ $o->name }}</p>
                                    </td>

                                    <td class="text-center">
                                        @if($o->name != "Super Admin")
                                            <ul class="list-inline">

                                                @if (auth('system_admin')->user()->can('edit_roles','system_admin'))
                                                    <li>
                                                        <a href="{{route('system.roles.update',$o->id)}}"
                                                           class="{{config('layout.classes.edit')}} mt-2"

                                                           data-toggle="tooltip" data-theme="dark" title="تعديل"
                                                        >
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>
                                                @endif

                                                @if (auth('system_admin')->user()->can('delete_roles','system_admin'))
                                                    <li>
                                                        <button type="button"
                                                                data-id="{{$o->id}}"
                                                                data-url="{{route('system.roles.delete')}}"
                                                                data-token="{{csrf_token()}}"
                                                                data-toggle="tooltip" data-theme="dark"
                                                                title="حذف"
                                                                class="{{config('layout.classes.delete')}} mt-2 btn-del">
                                                            <i class="{{config('layout.icons.delete_icon')}} "></i>
                                                            حذف
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {!! $out->links() !!}
                @else
                    <div class="note note-info">
                        <h4 class="block">لا يوجد بيانات مضافة</h4>
                    </div>
                @endif

            </div>
        </div>



    @endcomponent


@endsection
