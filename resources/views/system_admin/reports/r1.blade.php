@extends('layouts.admin')
@section('page_content')




    @component('components.ShowCard',[
'Disname'=>'التقارير',
'Disinfo'=>'تقارير الطلبات',
'module'=>'orders',
'actions'=>[
]
])


        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            @component('components.serach.select',['key'=>'status',
                                               'text'=>'اختر الحالة',
                                            'select'=>$cases])
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
                        <th class="text-center">السعر الكلي</th>
                        <th class="text-center">عدد المنتجات</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center">تاريخ الطلب</th>
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

                                    {{$a->total_price}} {{\App\Models\Settings::get('currency_ar')}}
                            </td>
                            <td class="text-center">
                                {{$a->products()->count()}} منتج
                            </td>

                            <td class="text-center" id="STAT_<?= $a->id ?>">
                                <span style="color: {{@$a->status->color_hex}}">{{@$a->status->name}}</span>
                            </td>
                            <td class="text-center">
                                {{$a->created_at->format('Y-m-d \الساعة H:i')}}
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
