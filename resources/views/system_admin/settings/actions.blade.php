@extends('layouts.admin')

@php
    $Disname='الاعدادات';
    $Disinfo='الاعدادات الخاصة بالنظام ';
@endphp
@section('title',  $Disname)
@section('head')

@endsection
@section('page_content')


    <div class="card card-custom">
        <div class="card-header  card-header-tabs-line">
            <div class="card-title">
                <h3 class="card-label">{{$Disname}}
                    <div class="text-muted pt-2 font-size-sm">{{$Disinfo}}</div>
                </h3>
            </div>
            <div class="card-toolbar">


                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                    <li class="nav-item ">
                        <a class="nav-link active" data-toggle="tab" href="#tab1">
                            اعدادات قاعدة البيانات
                        </a>
                    </li>


                </ul>
            </div>

        </div>

        <div class="card-body">

        <div class="m-content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->

                            <div class="tab-content">

                                <div class="tab-pane active" id="tab1" role="tabpanel">

                                    @if(Auth::guard('system_admin')->user()->id == 1)
                                    <div class="row justify-content-center">


                                        <div class="col-md-6 my-3">
                                            <h3 class="text-center">تصدير قاعدة البيانات</h3>
                                            <p class="text-center">عند الضغط على تصدير قاعدة البيانات سيتم حفظ محتويات قاعدة البيانات الى ملف SQL</p>
                                            <form action="{{route('system.settings.exportDB')}}" method="post" target="_blank">
                                                @csrf
                                                <button type="submit" class="{{config('layout.classes.edit')}} btn-block">
                                                    <i class="fas fa-download"></i>
                                                    <span>تصدير قاعدة البيانات</span>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6 my-3">
                                            <hr>
                                            <hr>
                                            <hr>
                                            <h3 class="text-center text-danger">تفريغ قاعدة البيانات</h3>
                                            <p class="text-center text-danger">عند الضغط على تفريغ قاعدة البيانات سيتم مسح التالي</p>
                                            <ul>
                                                <li class=" text-danger">جميع المدراء ما عدا المدير الرئيسي</li>
                                                <li class=" text-danger">جميع الاعدادات</li>
                                                <li class=" text-danger">جميع المنتجات</li>
                                                <li class=" text-danger">جميع الطلبات</li>
                                                <li class=" text-danger">جميع التحويلات</li>
                                                <li class=" text-danger">جميع التصنيفات</li>
                                                <li class=" text-danger">جميع المستخدمين</li>
                                                <li class=" text-danger">جميع حركات المستخدمين</li>
                                                <li class=" text-danger">جميع الاشعارات</li>
                                                <li class=" text-danger">جميع تواصل معنا</li>
                                                <li class=" text-danger">جميع محتويات الصفحات الثابتة</li>
                                            </ul>
                                            <h2 class="text-center text-danger" >لا يمكن التراجع عن عملية التفريغ</h2>

                                            <form action="{{route('system.settings.trancateDB')}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-light-danger font-weight-bold btn-pill btn-block">
                                                    <i class="fas fa-trash"></i>
                                                    <span>تفريغ قاعدة البيانات</span>
                                                </button>
                                            </form>
                                        </div>

                                    </div>

                                   @endif
                                </div>


                            </div>




            </div>
        </div>
    </div>
        </div>

    </div>

@endsection



@section('custom_scripts')
    <script>
        $(function () {
            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',

            }).init();


        })

    </script>

@endsection
