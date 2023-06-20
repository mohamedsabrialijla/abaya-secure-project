@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.orderCases.index'),'title'=>'حالات الطلب']
        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'حالات الطلب',
'Disinfo'=>'ادارة حالات الطلب',
'add_url'=>null,
'module'=>'orderCases',
'actions'=>[

]
])
        <div class="row">

            <div class="col-lg-12">


                @if(isset($out) && count($out) > 0)
                    <div>
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
                                <th class="text-center">الاسم</th>
                                <th class="text-center">اللون</th>
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
                                        <p>{{ $o->name_ar }}</p>
                                        <p>{{$o->name_en}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="label mr-2" style="background-color: {{$o->hex_color}}"></span>
                                    </td>
                                    <td class="text-center">

                                        <ul class="list-inline">

                                            @if(auth('system_admin')->user()->can('edit_orderCases','system_admin'))

                                                <li>
                                                    <a href="{{route('system.orderCases.update',$o->id)}}"
                                                       class="{{config('layout.classes.edit')}} mt-2"

                                                       data-toggle="tooltip" data-theme="dark" title="تعديل"
                                                    >
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                            @endif
                                        </ul>

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
