@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.styles.index'),'title'=>'الموديلات']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'الموديلات',
'Disinfo'=>'تعديل بيانات موديل',
'add_url'=>route('system.styles.do.update',$out->id),
'back_url'=>'system.styles.index',
'action'=>'edit',


])

        <div class="row justify-content-center">
           

            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'الموديل باللغة العربية','placeholder'=>'ادخل الموديل  العربية','icon'=>'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'الموديل باللغة الانجليزية','placeholder'=>'ادخل الموديل باللغة الانجليزية','icon'=>'fa-user-alt'])
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





