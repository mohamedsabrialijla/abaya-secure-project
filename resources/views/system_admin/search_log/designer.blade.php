@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>'','title'=>'كلمات البحث'],
        ]"/>
@endsection
@section('page_content')

@component('components.ShowCard',[
'Disname'=>'كلمات البحث',
'Disinfo'=>' إدارة كلمات البحث واجهة المصمم',
'module'=>'search_log',
'actions'=>[
       [
            'route'=>'system.search.log.designer.destroy',
            'icon'=>config('layout.icons.delete_icon'),
            'text'=>'حذف',
            'role'=>"delete",
        ]
   ]
])
        <div class="row">
            <div class="col-lg-12">


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

                                <th class="text-center">كلمة البحث</th>
                                <th class="text-center">عدد النتائج </th>
                                <th class="text-center">تاريخ البحث</th>
                                <th class="text-center">الإعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($out as $o)
                                <tr id="TR_{{$o->id}}">

                                    <td class="LOOPIDS">{{$loop->iteration}}</td>
                                    <td style="text-align: center;vertical-align: middle;">
                                        <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table">
                                            <input type="checkbox" value="{{ $o->id}}" name="Item[]"
                                                   class="CheckedItem" id="che_{{$o->id}}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td >
                                        {{$o->text}}
                                    </td>

                                    <td class="text-center">
                                        {{$o->results_count}}
                                    </td>
                                    <td class="text-center"> {{@$o->created_at->toDateString()}}</td>
                                    <td class="text-center">
                                        <ul class="list-inline">

                                        <li>
                                            <button type="button"
                                                    data-id="{{$o->id}}"
                                                    data-url="{{route('system.search.log.designer.destroy')}}"
                                                    data-token="{{csrf_token()}}"
                                                    data-toggle="tooltip" data-theme="dark" title="حذف"
                                                    class="{{config('layout.classes.delete')}} mt-2 btn-del">
                                                <i class="{{config('layout.icons.delete_icon')}}"></i>
                                                حذف
                                            </button>
                                        </li>
                                        </ul>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>


@endcomponent
@endsection
