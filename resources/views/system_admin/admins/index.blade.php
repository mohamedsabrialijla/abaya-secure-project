@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
    'Disname'=>'الادارة',
    'Disinfo'=>'ادارة مديري لوحة التحكم',
    'add_url'=>'system.admin.create',
    'module'=>'admins',
    'actions'=>[
        [
            'route'=>'system.admin.delete',
            'icon'=>config('layout.icons.delete_icon'),
            'text'=>'حذف',
            'role'=>"delete",
        ]
    ]
    ])
        <div class="row">

            <div class="row">
                <div class="col">
                    <form class="form-inline" style="float: right">
                        <div class="form-group m-form__group">

                            @component('components.serach.inputwithsearch',['inputs'=>['name'=>'الاسم']])
                            @endcomponent
                            <a href="{{route('system.admin.index')}}"
                               class="{{config('layout.classes.delete')}} mb-4 ml-5">
                                <i class="fa fa-refresh"></i> تفريغ
                            </a>
                        </div>

                    </form>
                </div>


            </div>
            <div class="col-lg-12">
                @if(isset($out) && count($out) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center table-td-small">#</th>
                                <th class="text-center table-td-small">
                                    <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                        <input type="checkbox" id="SelectAll">
                                        <span></span>
                                    </label>


                                </th>

                                <th class="text-right"> الاسم</th>
                                <th class="text-center"> اسم المستخدم</th>
                                <th class="text-center"> الجوال</th>
                                {{--<th> الحالة</th>--}}
                                <th class="text-center">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($out as $o)
                                <tr id="TR_{{$o->id}}">

                                    <td class="text-center table-td-small LOOPIDS">{{$loop->iteration}}</td>
                                    <td class="text-center table-td-small">
                                        @if($o->id !=1)
                                            <label
                                                class="checkbox checkbox-outline checkbox-success justify-content-center">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                       class="CheckedItem"
                                                       id="che_{{$o->id}}">
                                                <span></span>
                                            </label>

                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <img src="{{$o->image_url}}" class="img_table" alt="">
                                        {{$o->name}}
                                    </td>
                                    <td class="text-center">{{$o->email}}</td>
                                    <td class="text-center">{{$o->mobile}}</td>
                                    {{--                                <td>{{$o->status == 1?'مفعل':'معطل'}}</td>--}}

                                    <td class="text-center">
                                        @if($o->id !=1)
                                            <ul class="list-inline">

                                                @if(auth('system_admin')->user()->can('edit_admins','system_admin'))
                                                    <li>
                                                        <a href="{{route('system.admin.update',$o->id)}}"
                                                           class="{{config('layout.classes.edit')}} mt-1"
                                                           data-toggle="tooltip" data-theme="dark"
                                                           title="تعديل البيانات"
                                                        >
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{route('system.admin.password',$o->id)}}"
                                                           class="{{config('layout.classes.black')}} mt-2"
                                                           data-toggle="tooltip" data-theme="dark"
                                                           title="تعديل كلمة المرور">
                                                            <i class="fa fa-lock"></i> كلمة المرور </a>
                                                    </li>
                                                @endif

                                                @if(auth('system_admin')->user()->can('delete_admins','system_admin'))
                                                    <li>
                                                        <button type="button"
                                                                data-id="<?= $o->id ?>"
                                                                data-url="{{route('system.admin.delete')}}"
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
                        <h4 class="block">لا يوجد بيانات للعرض</h4>
                    </div>
                @endif
            </div>
        </div>


    @endcomponent

@endsection
