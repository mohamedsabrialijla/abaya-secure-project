@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories_special.index'),'title'=>'التصنيفات']
        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'التصنيفات',
'Disinfo'=>'ادارة التصنيفات',
'add_url'=>'system.categories_special.create',
'module'=>'categories',
'actions'=>[
        [
           'route'=>'system.categories_special.activate',
           'icon'=>config('layout.icons.activate_icon'),
           'text'=>'تفعيل',
           'role'=>"activate",
       ],
       [
           'route'=>'system.categories_special.deactivate',
           'icon'=>config('layout.icons.deactivate_icon'),
           'text'=>'تعطيل',
           'role'=>"activate",
       ],
        [
            'route'=>'system.categories_special.delete',
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

                            @component('components.serach.inputwithsearch',['inputs'=>['name'=>'اسم التصنيف']])
                            @endcomponent
                            <a href="{{route('system.categories_special.index')}}"
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
                                <th class="text-center">صورة التصنيف</th>
                                <th class="text-center">اسم التصنيف</th>
                                <th class="text-center">عدد المنتجات</th>
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
                                    <td>
                                        <img style="background-color: #ccc;" src="{{ $o->image_url }}" class="img_table"
                                             alt="">
                                    </td>
                                    <td class="text-center">
                                        <p>{{ $o->name_ar }}</p>
                                        <p>{{$o->name_en}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p>{{ $o->products_count }}</p>
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
                                            @if(auth('system_admin')->user()->can('edit_categories','system_admin'))
                                                <li>
                                                    <a href="{{route('system.categories_special.update',$o->id)}}"
                                                       class="{{config('layout.classes.edit')}} mt-2"

                                                       data-toggle="tooltip" data-theme="dark" title="تعديل">
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                            @endif
                                            @if(auth('system_admin')->user()->can('delete_categories','system_admin'))
                                                <li>

                                                    @if($o->can_del)
                                                    <button class="{{config('layout.classes.delete')}} mt-2 btn-del"
                                                            data-id="<?= $o->id ?>"
                                                            data-toggle="tooltip" data-theme="dark"
                                                            data-url="{{route('system.categories_special.delete')}}"
                                                            data-token="{{csrf_token()}}"
                                                            title="حذف"><i class="fa fa-trash"> </i>حذف
                                                    </button>
                                                    @else
                                                        <button type="button"
                                                                data-toggle="tooltip" data-theme="dark"
                                                                title="لا يمكن حذف التصنيف لوجود منتجات تابعة له"
                                                                class="{{config('layout.classes.delete')}} mt-2 disabled">
                                                            <i class="fa fa-trash "></i>
                                                            حذف
                                                        </button>
                                                   @endif
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
