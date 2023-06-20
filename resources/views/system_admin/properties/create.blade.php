@extends('layouts.admin')
@section('hor_menu')
    {{ Menu::renderHorMenu(config('menu_header.properties')) }}
@endsection

@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'خصائص المنتجات',
'Disinfo'=>'اضافة خاصية منتج جديدة',
'add_url'=>route('system.properties.do.create'),
'back_url'=>'system.properties.index',
'action'=>'add',


])
        <div class="row justify-content-center">

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['name'=>'name_ar','text'=>'الاسم','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','text'=>'name','placeholder'=>'Enter the name','icon'=>'fa-user-alt'])
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





