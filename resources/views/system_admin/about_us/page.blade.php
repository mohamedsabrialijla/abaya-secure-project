@extends('layouts.admin')

@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'عن التطبيق',
'Disinfo'=>'تعديل بيانات عن التطبيق',
'add_url'=>route('system.settings.postAbout'),
'back_url'=>'system_admin.dashboard',
'action'=>'edit',


])

        <div class="row">
            <div class="col-md-12">

                @component('components.area_editor',['data'=>HELPER::set_if($page['about_us_ar']),'name'=>'about_us_ar','text'=>'التفاصيل باللغة العربية '])
                @endcomponent

            </div>
            <div class="col-md-12">

                @component('components.area_editor',['data'=>HELPER::set_if($page['about_us_en']),'name'=>'about_us_en','text'=>'التفاصيل باللغة الإنجليزية '])
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
