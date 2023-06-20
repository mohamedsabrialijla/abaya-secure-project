@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ]"/>
@endsection
@section('head')

@endsection
@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'الادارة',
'Disinfo'=>'اضافة مدير جديد',
'add_url'=>route('system.admin.do.create'),
'back_url'=>'system.admin.index',
'action'=>'add',


])

            <div class="row justify-content-center align-items-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            @component('components.input',['name'=>'name','text'=>'الاسم','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt'])
                            @endcomponent


                        </div>
                        <div class="col-md-6">
                            @component('components.input',['name'=>'username','text'=>'اسم المستخدم','placeholder'=>'ادخل اسم المستخدم','icon'=>'fa-user-alt'])
                            @endcomponent

                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">

                            @component('components.input',['name'=>'mobile','text'=>'رقم الجوال','placeholder'=>'ادخل رقم الجوال','icon'=>'fa-phone'])
                            @endcomponent

                        </div>
                        <div class="col">

                            @component('components.input',['name'=>'password','type'=>'password','text'=>'كلمة المرور','placeholder'=>'ادخل كلمة المرور','icon'=>'fa-lock'])
                            @endcomponent
                        </div>
                        <div class="w-100"></div>

                        <div class="col-md-6">

                            @component('components.select',['name'=>'roles','text'=>'الصلاحية','placeholder'=>'اختر الصلاحية','icon'=>'fa-cog','select'=>$roles])
                            @endcomponent

                        </div>
                        <div class="w-100"></div>
                    </div>

                </div>
                <div class="col-md-2">
                    @component('components.upload_image',['name'=>'image','text'=>'صورة الحساب','hint'=>'100 * 100 بيكسل'])
                    @endcomponent
                </div>

                <div class="clearfix"></div>
            </div>




    @endcomponent

@endsection





@section('custom_scripts')
    <script>
        $(function () {
            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price: {
                        required: true,
                        number: true
                    }
                }

            }).init();


        })

    </script>

@endsection


