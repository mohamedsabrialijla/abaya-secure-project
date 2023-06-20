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
'Disinfo'=>'تعديل بيانات المدير',
'add_url'=>route('system.admin.do.update',$out->id),
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

                        @component('components.input',['name'=>'mobile','data'=>substr($out->mobile, 3, 12),'text'=>'رقم الجوال','placeholder'=>'ادخل رقم الجوال','icon'=>'fa-phone'])
                        @endcomponent

                    </div>
                    <div class="w-100"></div>

                    <div class="col-md-6">

                        @component('components.select',['data'=>@$myRole->role_id,'name'=>'roles','text'=>'الصلاحيات','placeholder'=>'اختر الصلاحيات','icon'=>'fa-cog','select'=>$roles])
                        @endcomponent

                    </div>

                    <div class="w-100"></div>
                </div>

            </div>
            <div class="col-md-2">
                @component('components.upload_image',['name'=>'image','data'=>$out->avatar,'text'=>'صورة الحساب','hint'=>'100 * 100 بيكسل'])
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


