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
                        <a class="nav-link   " href="{{route('system.translations.index')}}">
                            نصوص الاشعارات
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link active" href="{{route('system.translations.apiTexts')}}">
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
                        <form action="{{route('system.translations.saveApi')}}" method="post" id="form" >

                            @foreach($translations as $id=>$o)
                                <div class="row justify-content-center align-content-center">
                                    @foreach($o as $local=>$trans)
                                        <div class="col-md-5">
                                            @component('components.input',['name'=>$id.'_'.$local,'data'=>$trans->value,'text'=>$local=='ar'?'النص بالعربية':'النص بالإنجليزية','placeholder'=>$local,'icon'=>'fa-asterisk'])
                                            @endcomponent
                                        </div>
                                    @endforeach
                                    <div class="col-md-2 row justify-content-center align-content-center">
                                        <div style="margin: 5px;padding: 10px;border:2px solid #ddd;border-radius: 10px;overflow: hidden;width: 100%">
                                            <p class="text-center" style="margin: 0">{{$id}}</p>
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











