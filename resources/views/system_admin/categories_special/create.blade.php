@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories_special.index'),'title'=>'التصنيفات']
        ]"/>
@endsection

@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'التصنيفات',
'Disinfo'=>'اضافة تصنيف جديد',
'add_url'=>route('system.categories_special.do.create'),
'back_url'=>'system.categories_special.index',
'action'=>'add',


])
        <div class="row justify-content-center">

            <div class="col-md-3">
                @component('components.upload_image',['name'=>'image','text'=>'صورة التصنيف','hint'=>'235 * 1110 بيكسل'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['name'=>'name_ar','text'=>'اسم التصنيف بالعربية','placeholder'=>'ادخل اسم التصنيف بالعربية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','text'=>'اسم التصنيف بالانجليزية','placeholder'=>'ادخل اسم التصنيف بالانجليزية','icon'=>'fa-user-alt'])
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



    </script>



@endsection





