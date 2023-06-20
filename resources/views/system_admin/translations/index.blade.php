@extends('layouts.admin')

@php
    $Disname='النصوص';
    $Disinfo='ترجمات النصوص الخاصة بالتطبيق ';
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

                    <li class="nav-item m-tabs__item ">
                        <a class="nav-link  active " href="{{route('system.translations.index')}}">
                            نصوص الاشعارات
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link" href="{{route('system.translations.apiTexts')}}">
                            نصوص الAPI
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


                        <form action="{{route('system.translations.saveText')}}" method="post" id="form" >

                            @foreach($out as $o)
                                <div class="row row justify-content-center align-content-center">
                                    <div class="col-md-5">
                                        @component('components.input',['name'=>$o->notification_key.'_title_ar','data'=>$o->title_ar,'text'=>'العنوان','placeholder'=>'ادخل العنوان','icon'=>'fa-edit'])
                                        @endcomponent
                                            @component('components.input',['rows'=>2,'name'=>$o->notification_key.'_message_ar','data'=>$o->message_ar,'text'=>'النص','placeholder'=>'ادخل النص','icon'=>'fa-edit'])
                                            @endcomponent
                                    </div>
                                    <div class="col-md-5">
                                        @component('components.input',['name'=>$o->notification_key.'_title_en','data'=>$o->title_en,'text'=>'Title','placeholder'=>'Enter Title','icon'=>'fa-edit'])
                                        @endcomponent
                                            @component('components.input',['rows'=>2,'name'=>$o->notification_key.'_message_en','data'=>$o->message_en,'text'=>'Message','placeholder'=>'Enter Message','icon'=>'fa-edit'])
                                            @endcomponent
                                    </div>
                                    <div class="col-md-2 row justify-content-center align-content-center">
                                        <div style="margin: 5px;padding: 10px;border:2px solid #ddd;border-radius: 10px;overflow: hidden;width: 100%">
                                            <p class="text-center" style="margin: 0">{{$o->notification_key}}</p>
                                            <hr style="margin: 3px">
                                            <p class="text-center" style="margin: 0">البيانات مع الاشعار</p>
                                            <hr style="margin: 3px">
                                            @if($o->data_to_send)
                                                @foreach($o->data_to_send as $d)
                                                    <p class="text-center" style="margin: 0">{{$d}}</p>
                                                @endforeach
                                            @else
                                                {{'-'}}
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            @endforeach

                            @csrf

                            <div class="clearfix"></div>
                            <br>

                            <div class="col">
                                <button type="submit" class="{{config('layout.classes.submit')}}">
                                    <i class="fa fa-check"></i>
                                    <span>تعديل</span>
                                </button>
                                <a href="{{route('system_admin.dashboard')}}" class="{{config('layout.classes.cancel')}}">
                                    <i class="la la-times"></i>
                                    <span>الغاء</span>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </form>



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


