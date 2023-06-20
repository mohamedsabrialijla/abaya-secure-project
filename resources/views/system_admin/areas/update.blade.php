@extends('layouts.admin')
@section('hor_menu')
    {{ Menu::renderHorMenu(config('menu_header.areas')) }}
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'المحافظات والمدن',
'Disinfo'=>'تعديل محافظة ',
'add_url'=>route('system.areas.do.update',$out->id),
'back_url'=>'system.areas.index',
'action'=>'EDIT',


])

        <div class="row justify-content-center">


            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name,'name'=>'name_ar','text'=>'الاسم','placeholder'=>'ادخل الاسم','$no_def'=>'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'name','placeholder'=>'Enter the name','icon'=>'fa-user-alt'])
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





