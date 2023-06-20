@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.sizes.index'),'title'=>'المقاسات']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'المقاسات',
'Disinfo'=>'تعديل بيانات مقاس',
'add_url'=>route('system.sizes.do.update',$out->id),
'back_url'=>'system.sizes.index',
'action'=>'edit',


])

        <div class="row justify-content-center">
            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'المقاس باللغة العربية','placeholder'=>'ادخل المقاس باللغة العربية','icon'=>'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'المقاس باللغة الانجليزية','placeholder'=>'ادخل المقاس باللغة الانجليزية','icon'=>'fa-user-alt'])
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





