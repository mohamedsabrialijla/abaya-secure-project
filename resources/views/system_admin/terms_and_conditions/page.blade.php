@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.settings.getTerms'),'title'=>'الشروط و الأحكام']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'الشروط و الأحكام',
'Disinfo'=>'تعديل بيانات الشروط و الأحكام',
'add_url'=>route('system.settings.postTerms'),
'back_url'=>'system_admin.dashboard',
'action'=>'edit',


])

        <div class="row">
            <div class="col-md-12">

                @component('components.area_editor',['data'=>HELPER::set_if($page['terms_and_conditions_ar']),'name'=>'terms_and_conditions_ar','text'=>'التفاصيل باللغة العربية '])
                @endcomponent

            </div>
            <div class="col-md-12">

                @component('components.area_editor',['data'=>HELPER::set_if($page['terms_and_conditions_en']),'name'=>'terms_and_conditions_en','text'=>'التفاصيل باللغة الإنجليزية '])
                @endcomponent

            </div>

        </div>
    @endcomponent
@endsection




@section('custom_scripts')

    <script>
        $(document).ready(function () {
            var form3 = $('#form');
            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error'
            }).init();


        });
    </script>
@endsection
