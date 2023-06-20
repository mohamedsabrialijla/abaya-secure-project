@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.stores.index'),'title'=>'المصممون'],

        ]"/>
@endsection

@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'المصممون',
'Disinfo'=>'اضافة مصمم جديد',
'add_url'=>route('system.stores.do.create'),
'back_url'=>'system.stores.index',
'action'=>'add',


])

        <div class="row">
            <div class="col-10">
                <div class="row">

                    <div class="col-md-6">
                        @component('components.input',['name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم باللغة العربية','icon'=>'fa-user-alt'])
                        @endcomponent
                    </div>
                    <div class="col-md-6">
                        @component('components.input',['name'=>'name_en','text'=>'الاسم باللغة الانجليزية','placeholder'=>'ادخل الاسم باللغة الانجليزية','icon'=>'fa-user-alt'])
                        @endcomponent
                    </div>
                    <div class="w-100"></div>

                    <div class="col-md-6">
                        @component('components.input',['name'=>'mobile','text'=>'الجوال','placeholder'=>'ادخل رقم الجوال','not_req'=>true,'class'=>'isNumber'])
                        @endcomponent
                    </div>
                    <div class="w-100"></div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        @component('components.input',['name'=>'whatsapp','text'=>'واتس آب','not_req'=>true , 'hint'=>'555-555-566','icon'=>'fa-user-alt','class'=>'isNumber'])
                        @endcomponent
                    </div>
                    <div class="col-md-4">
                        @component('components.input',['name'=>'instagram','text'=>'انستاجرام','not_req'=>true , 'hint'=>'اسم حساب انستاجرام','icon'=>'fa-user-alt'])
                        @endcomponent
                    </div>

                    <div class="col-md-4">
                        @component('components.input',['name'=>'snapchat','text'=>'سناب شات','not_req'=>true , 'hint'=>'اسم حساب سناب شات','icon'=>'fa-user-alt'])
                        @endcomponent
                    </div>
                    <div class="w-100"></div>


                    <div class="w-100"></div>
                </div>

                <div class="w-100"></div>
                <div class="row">
                    <div class="col-md-12">
                        @component('components.area_editor',['name'=>'return_policy_ar','text'=>'سياسة الارجاع باللغة العربية '])
                        @endcomponent
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        @component('components.area_editor',['name'=>'return_policy_en','text'=>'سياسة الارجاع باللغة بالانجليزية '])
                        @endcomponent
                    </div>
                    <div class="w-100"></div>
                </div>

            </div>
            <div class="col-md-2">
                @component('components.upload_image',['name'=>'logo','text'=>'شعار المصمم','hint'=>'60 * 60 بيكسل'])
                @endcomponent
            </div>
            <div class="clearfix"></div>
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





