@extends('layouts.admin')

@section('page_content')



    @component('components.ShowCard',[
'Disname'=>'محفظة المستخدم',
'Disinfo'=>'ادارة ارصدة المستخدمين',
'module'=>' balance',
'actions'=>[

]
])

        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            @component('components.serach.inputwithsearch',['inputs'=>[
    'name'=>'بحسب الاسم',
    'mobile'=>'بحسب الجوال',
    'email'=>'بحسب الايميل',
    ]])
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
                        <th class="text-center">الإسم</th>
                        <th class="text-center">رقم الجوال</th>
                        <th class="text-center">المدفوعات</th>

                        <th class="text-center">المضافات</th>
                        <th class="text-center">الرصيد الحالي</th>
                        <th class="text-center">الإعدادات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($out as $o)
                        <tr id="TR_{{$o->id}}">

                            <td class="LOOPIDS">{{$loop->iteration}}</td>

                            <td class="text-center"><a
                                    href="{{route('system.users.details',$o->id)}}">{{str_limit($o->name, 30)}}</a>
                            </td>
                            <td class="text-center"> {{$o->mobile??'-'}}</td>
                            <td class="text-center"><span class="text-danger">{{$o->neg_balance . ' '.\App\Models\Settings::get('currency_ar')}}</span></td>
                            <td class="text-center"> <span class="text-success">{{$o->pos_balance . ' '.\App\Models\Settings::get('currency_ar')}}</span></td>
                            <td class="text-center">{{$o->balance . ' '.\App\Models\Settings::get('currency_ar')}}</td>
                            <td class="text-center">
                                <ul class="list-inline">
                                    <li>
                                        <a href="{{route('system.balance.userBalance',$o->id)}}"
                                           class="{{config('layout.classes.edit')}}"
                                           data-toggle="tooltip" data-theme="dark" title="الحركات المالية"
                                        >
                                            <i class="far fa-money-bill-alt"></i> الحركات المالية
                                        </a>
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
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        @endif
    @endcomponent



@endsection

@section('custom_scripts')
@endsection
