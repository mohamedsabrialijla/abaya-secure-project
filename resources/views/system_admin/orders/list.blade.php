@extends('layouts.admin')
@section('page_content')




    @component('components.ShowCard',[
'Disname'=>'الطلبات',
'Disinfo'=>'ادارة الطلبات الجديدة في الموقع',
'module'=>'orders',
'actions'=>[
]
])

        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            @component('components.serach.select',['key'=>'status_id',
                   'text'=>'اختر الحالة',
                'select'=>$statuses])
                            @endcomponent
                            @component('components.serach.dateRanger')
                            @endcomponent
                            @component('components.serach.input',['inputs'=>['price_from'=>'السعر من','price_to'=>'السعر الى']])
                            @endcomponent
                            @component('components.serach.inputwithsearch',['inputs'=>['name'=>'الاسم']])
                            @endcomponent
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
                        <th class="text-center">رقم الطلب</th>
                        <th class="text-center">الاسم</th>
                        <th class="text-center">المستخدم</th>
                        <th class="text-center">السعر الكلي</th>
                        <th class="text-center">عدد المنتجات</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center">الإعدادات</th>
                    </tr>
                    </thead>
                    <tbody id="OrderList">
                    <tr></tr>

                    @foreach($out as $a)

                        <tr id="TR_{{$a->id}}">
                            <td class="LOOPIDS">{{ ($out->currentpage()-1) * $out ->perpage() + $loop->index + 1 }}</td>
                            <td class="text-center">
                                <a href="{{route('system.orders.details',$a->id)}}" target="_blank"> <?= $a->id ?></a>
                            </td>
                            <td class="text-center">
                                <?= $a->name ?>
                            </td>
                            <td class="text-center">
                                {{@$a->user->name}}
                            </td>
                            <td class="text-center">
                                @if($a->total_price_local != $a->total_price)
                                    {{$a->total_price}} {{\App\Models\Settings::get('currency_ar')}}
                                    <br>
                                    {{$a->total_price_local}} {{$a->currency}}

                                @else
                                    {{$a->total_price}} {{\App\Models\Settings::get('currency_ar')}}
                                @endif
                            </td>
                            <td class="text-center">
                                {{$a->products()->count()}}
                            </td>

                            <td class="text-center" id="STAT_<?= $a->id ?>">
                                <span style="color: {{@$a->status->color_hex}}">{{@$a->status->name}}</span>
                            </td>
                            <td class="text-center">
                                <ul class="list-inline">
                                    <li>
                                        <a href="{{route('system.orders.details',$a->id)}}"
                                           class="{{config('layout.classes.edit')}}"
                                           data-toggle="tooltip" data-theme="dark" title="عرض التفاصيل"
                                        >
                                            <i class="fa fa-desktop"></i> عرض </a>
                                    </li>
                                    @if($a->case_id < 3)
                                        <li>
                                            <button type="button"
                                                    data-id="{{$a->id}}"
                                                    data-url="{{route('system.orders.delete')}}"
                                                    data-token="{{csrf_token()}}"
                                                    data-toggle="tooltip" data-theme="dark" title="حذف"
                                                    class=" {{config('layout.classes.delete')}} btn-del">
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
                {{$out->links()}}
            </div>
        @else
            <div class="note note-info">
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        @endif
    @endcomponent

@endsection
