@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.clothes.index'),'title'=>'الأقمشة']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'الأقمشة',
'Disinfo'=>'تعديل بيانات قماش',
'add_url'=>route('system.clothes.do.update',$out->id),
'back_url'=>'system.clothes.index',
'action'=>'edit',


])

        <div class="row justify-content-center">
           

            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'قماش باللغة العربية','placeholder'=>'ادخل القماش  العربية','icon'=>'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'قماش باللغة الانجليزية','placeholder'=>'ادخل القماش باللغة الانجليزية','icon'=>'fa-user-alt'])
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





