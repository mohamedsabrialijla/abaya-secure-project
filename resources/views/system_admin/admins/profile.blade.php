@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'الادارة',
'Disinfo'=>'تعديل بياناتي',
'add_url'=>route('system.admin.do.profile',$out->id),
'back_url'=>'system.admin.index',
'action'=>'edit',


])

        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        @component('components.input',['name'=>'name','data'=>$out->name,'text'=>'الاسم','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt'])
                        @endcomponent


                    </div>
                    <div class="col-md-6">
                        @component('components.input',['name'=>'username','data'=>$out->email,'text'=>'اسم المستخدم','placeholder'=>'ادخل اسم المستخدم','icon'=>'fa-user-alt'])
                        @endcomponent

                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">

                        @component('components.input',['name'=>'mobile','data'=>$out->mobile,'text'=>'رقم الجوال','placeholder'=>'ادخل رقم الجوال','icon'=>'fa-phone'])
                        @endcomponent

                    </div>

                    <div class="w-100"></div>
                </div>

            </div>
            <div class="col-md-2">
                @component('components.upload_image',['name'=>'image','data'=>$out->avatar,'text'=>'صورة الحساب','hint'=>'100 * 100 بيكسل'])
                @endcomponent
                    <div class="col">
                        <a href="{{route('system.admin.profile.password')}}" style="margin: 25px auto;"
                           class="{{config('layout.classes.edit')}} btn-block" data-aaa="tooltip" title="تغيير كلمة المرور">
                            <i class="fa fa-lock"></i> تغيير كلمة المرور </a>
                    </div>
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
