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
'Disinfo'=>'تعديل بيانات حالة الطلب',
'add_url'=>route('system.orderCases.do.update',$out->id),
'back_url'=>'system.orderCases.index',
'action'=>'edit',


])

        <div class="row justify-content-center">

            <div class="col-md-10">
                @component('components.colorpicker',['data'=>$out->hex_color,'name'=>'hex_color','text'=>'اللون'])
                @endcomponent
            </div>

            <div class="col-md-2">
                @component('components.switch',['data'=>$out->is_active,'name'=>'is_active','text'=>'الحالة'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم باللغة العربية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_en,'name'=>'name_en','text'=>'الاسم باللغة الإنجليزية','placeholder'=>'ادخل الاسم باللغة الإنجليزية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->details_ar,'name'=>'details_ar','text'=>'الوصف باللغة العربية','placeholder'=>'ادخل الوصف باللغة العربية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.input',['data'=>$out->details_en,'name'=>'details_en','text'=>'الوصف باللغة الإنجليزية','placeholder'=>'ادخل الوصف باللغة الإنجليزية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>



            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->notification_title,'name'=>'notification_title','text'=>'  عنوان الاشعار','placeholder'=>'عنوان الاشعار   ','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->notification_text,'name'=>'notification_text','text'=>'نص الاشعار','placeholder'=>'نص الاشعار','icon'=>'fa-user-alt'])
                @endcomponent
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

        $('#start_date').datepicker();
        $('#expire_date').datepicker();

    </script>



@endsection





