@extends('layouts.admin')
@section('hor_menu')
    {{ Menu::renderHorMenu(config('menu_header.areas')) }}
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'المحافظات والمدن',
'Disinfo'=>'اضافة محافظة او مدينة جديدة',
'add_url'=>route('system.areas.do.create'),
'back_url'=>'system.areas.index',
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

            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.select',['name'=>'gov_id','text'=>'المنطقة','placeholder'=>'هذه منطقة','not_req'=>1,'select'=>$govs])
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





