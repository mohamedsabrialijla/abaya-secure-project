@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.clothes.index'),'title'=>'الاقمشة']
        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'الاقمشة',
'Disinfo'=>'ادارة الاقمشة',
'add_url'=>'system.clothes.create',
'module'=>'clothes',
'actions'=>[
        [
           'route'=>'system.clothes.activate',
           'icon'=>config('layout.icons.activate_icon'),
           'text'=>'تفعيل',
           'role'=>"activate",
       ],
       [
           'route'=>'system.clothes.deactivate',
           'icon'=>config('layout.icons.deactivate_icon'),
           'text'=>'تعطيل',
           'role'=>"activate",
       ],
       [
            'route'=>'system.clothes.delete',
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

                            @component('components.serach.inputwithsearch',['inputs'=>['name'=>'اسم الموديل']])
                            @endcomponent
                            <a href="{{route('system.clothes.index')}}"
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
                                <th>#</th>
                                <th width="5%" style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                        <input type="checkbox" id="SelectAll">
                                        <span></span>
                                    </label>

                                </th>

                                <th class="text-center">نوع القماش</th>
                                <th class="text-center">الحالة</th>
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
                                        @if($o->status == 1)
                                            <span class="m--font-success"> مفعل </span>
                                        @else
                                            <span class="m--font-warning"> معطل </span>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        <ul class="list-inline">
                                            @if(auth('system_admin')->user()->can('edit_clothes','system_admin'))
                                                <li>
                                                    <a href="{{route('system.clothes.update',$o->id)}}"
                                                       class="{{config('layout.classes.edit')}} mt-2"

                                                       data-toggle="tooltip" data-theme="dark" title="تعديل">
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                            @endif
                                            @if(auth('system_admin')->user()->can('delete_clothes','system_admin'))
                                                <li>
                                                    <?php if ($o->can_del) { ?>
                                                    <button class="{{config('layout.classes.delete')}} mt-2 btn-del"
                                                            data-id="<?= $o->id ?>"
                                                            data-toggle="tooltip" data-theme="dark"
                                                            data-url="{{route('system.clothes.delete')}}"
                                                            data-token="{{csrf_token()}}"
                                                            title="حذف"><i class="fa fa-trash"> </i>حذف
                                                    </button>
                                                    <?php }else{ ?>
                                                    <div style="display: inline-block;" data-skin="dark"
                                                         data-tooltip="m-tooltip" data-placement="top"
                                                         title="لا يمكن الحذف لوجود منتجات تابعة له">
                                                        <a class="{{config('layout.classes.delete')}} mt-2"
                                                           style="pointer-events: none;cursor: default;opacity: 0.7;color: #f4516c;"
                                                           data-skin="dark" data-tooltip="m-tooltip"
                                                           data-placement="top"
                                                           title="لا يمكن الحذف لوجود منتجات تابعة له">
                                                            <i class="fa fa-trash"></i>حذف
                                                        </a>
                                                    </div>
                                                    <?php } ?>
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
