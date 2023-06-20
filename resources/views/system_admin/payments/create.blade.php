@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.payments.index'), 'title' => 'طرق الدفع'],
    ]" />
@endsection

@section('page_content')

    @component('components.AddEditCard', [
        'Disname' => 'طرق الدفع',
        'Disinfo' => 'اضافة طريقة دفع جديدة',
        'add_url' => route('system.payments.do.create'),
        'back_url' => 'system.payments.index',
        'action' => 'add',
        ])
        <div class="row justify-content-center">

            <div class="col-md-3">
                @component('components.upload_image', ['name' => 'image', 'text' => 'أيقونة طريقة الدفع', 'hint' => '60 * 60
                    بيكسل'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input', ['name' => 'name_ar', 'text' => 'الاسم بالعربية', 'placeholder' => 'ادخل الاسم
                    بالعربية', 'icon' => 'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input', ['name' => 'name_en', 'text' => 'الاسم بالانجليزية', 'placeholder' => 'ادخل الاسم
                    بالانجليزية', 'icon' => 'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input', ['name' => 'ratio','type' =>'number', 'text' => 'نسبة العمولة', 'placeholder' => '%', 'icon' => 'fa-user-alt'])
                @endcomponent
            </div>

        </div>
    @endcomponent




    <!-- END PAGE BASE CONTENT -->

@endsection


@section('custom_scripts')
    <script>
        $(function() {

            $('#form').validate({

                errorElement: 'div', //default input error message container

                errorClass: 'abs_error help-block has-error',


            }).init();

        })
    </script>
@endsection
