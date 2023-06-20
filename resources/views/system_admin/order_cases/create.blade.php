@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.orderCases.index'),'title'=>'حالات الطلب']
        ]"/>
@endsection

@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'حالات الطلب',
'Disinfo'=>'اضافة حالة طلب جديدة',
'add_url'=>route('system.orderCases.do.create'),
'back_url'=>'system.orderCases.index',
'action'=>'add',


])
        <div class="row justify-content-center">

            <div class="col-md-10">
                @component('components.colorpicker',['name'=>'hex_color','text'=>'اللون'])
                @endcomponent
            </div>

            <div class="col-md-2">
                @component('components.switch',['id'=>'is_active'  ,'name'=>'is_active','text'=>'الحالة'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم باللغة العربية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','text'=>'الاسم باللغة الإنجليزية','placeholder'=>'ادخل الاسم باللغة الإنجليزية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['name'=>'details_ar','text'=>'الوصف باللغة العربية','placeholder'=>'ادخل الوصف باللغة العربية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.input',['name'=>'details_en','text'=>'الوصف باللغة الإنجليزية','placeholder'=>'ادخل الوصف باللغة الإنجليزية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

        </div>



        </div>

    @endcomponent




    <!-- END PAGE BASE CONTENT -->

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





