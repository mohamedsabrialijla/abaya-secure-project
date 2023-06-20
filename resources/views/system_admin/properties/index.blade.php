@extends('layouts.admin')
@section('hor_menu')
    {{ Menu::renderHorMenu(config('menu_header.properties')) }}
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'خصائص المنتجات',
'Disinfo'=>'ادارة خائص المنتجات',
'add_url'=>'system.properties.create',
'module'=>'properties',
'actions'=>[
        [
           'route'=>'system.properties.activate',
           'icon'=>config('layout.icons.activate_icon'),
           'text'=>'تفعيل',
           'role'=>"activate",
       ],
       [
           'route'=>'system.properties.deactivate',
           'icon'=>config('layout.icons.deactivate_icon'),
           'text'=>'تعطيل',
           'role'=>"activate",
       ],
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
                                <th class="text-center">الحالة</th>
                                {{--                                        <th class="text-center">الحالة</th>--}}
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

                                           <li>
                                                <a href="{{route('system.properties.update',$o->id)}}"
                                                   class="{{config('layout.classes.edit')}}"

                                                   data-toggle="tooltip" data-theme="dark" title="تعديل"
                                                >
                                                    <i class="fa fa-edit"></i> تعديل </a>
                                            </li>
                                          <li>
                                                <?php if ($o->can_del) { ?>
                                                <button class="{{config('layout.classes.delete')}} btn-del"
                                                        data-id="<?= $o->id ?>"
                                                        data-toggle="tooltip" data-theme="dark"
                                                        data-url="{{route('system.properties.delete')}}"
                                                        data-token="{{csrf_token()}}"
                                                        title="حذف"><i class="fa fa-trash"> </i>حذف
                                                </button>
                                                <?php }else{ ?>
                                                <div style="display: inline-block;" data-skin="dark"
                                                     data-tooltip="m-tooltip" data-placement="top"
                                                     title="لا يمكن الحذف لوجود منتجات تابعة له">
                                                    <a class="{{config('layout.classes.delete')}}"
                                                       style="pointer-events: none;cursor: default;opacity: 0.7;color: #f4516c;"
                                                       data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                                       title="لا يمكن الحذف لوجود منتجات تابعة له">
                                                        <i class="fa fa-trash"></i>حذف
                                                    </a>
                                                </div>

                                                <?php } ?>


                                            </li>

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
