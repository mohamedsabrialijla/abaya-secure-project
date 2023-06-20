@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.notifications.index'),'title'=>'الاشعارات']
        ]"/>
@endsection
@section('page_content')


    @component('components.ShowCard',[
'Disname'=>'الاشعارات',
'Disinfo'=>'ادارة الاشعارات العامة',
'add_url'=>'system.notifications.create',
'module'=>'notifications',
'actions'=>[
    [
        'route'=>'system.notifications.delete',
        'icon'=>config('layout.icons.delete_icon'),
        'text'=>'حذف',
        'role'=>"delete",
    ]
]
])
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            @component('components.serach.dateRanger')
                            @endcomponent

                                @component('components.serach.inputwithsearch',['inputs'=>['name'=>'عنوان الاشعار']])
                                @endcomponent

                                <a href="{{route('system.notifications.index')}}"
                                   class="{{config('layout.classes.delete')}} mb-4 mr-2">
                                    <i class="fa fa-refresh"></i> تفريغ
                                </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>

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
                        <th class="text-center">العنوان</th>
                        <th class="text-center">الرسالة</th>
                        <th class="text-center">تاريخ الارسال</th>
                        <th class="text-center">الإعدادات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($out as $o)
                        <tr id="TR_{{$o->id}}">

                            <td class="LOOPIDS">{{$loop->iteration}}</td>
                            <td style="text-align: center;vertical-align: middle;">
                                <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                    <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                                           id="che_{{$o->id}}">
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-center">{!! $o->title !!}</td>
                            <td class="text-center">{!! $o->message !!}</td>
                            <td class="text-center"><?=$o->created_at->toDateString()?></td>
                            <td class="text-center">

                                <ul class="list-inline">
                                    @if(auth('system_admin')->user()->can('delete_notifications','system_admin'))
                                        <li>
                                            <button type="button"
                                                    data-id="<?= $o->id ?>"
                                                    data-url="{{route('system.notifications.delete')}}"
                                                    data-token="{{csrf_token()}}"
                                                    data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                                    title="حذف"
                                                    class="{{config('layout.classes.delete')}} btn-del">
                                                <i class="{{config('layout.icons.delete_icon')}} "></i>
                                                حذف
                                            </button>
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
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        @endif
    @endcomponent

@endsection
