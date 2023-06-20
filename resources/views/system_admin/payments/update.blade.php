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
        'Disinfo' => 'تعديل طريقة الدفع تصنيف',
        'add_url' => route('system.payments.do.update', $out->id),
        'back_url' => 'system.payments.index',
        'action' => 'edit',
        ])
        <div class="row justify-content-center">
            <div class="col-md-3">
                @component('components.upload_image', ['data' => $out->icon, 'name' => 'image', 'text' => 'أيقونة طريقة الدفع',
                    'hint' => '60 * 60 بيكسل'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input', ['data' => $out->name_ar, 'name' => 'name_ar', 'text' => 'الاسم بالعربية',
                    'placeholder' => 'ادخل الاسم بالعربية', 'icon' => 'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input', ['name' => 'name_en', 'data' => $out->name_en, 'text' => 'الاسم بالانجليزية',
                    'placeholder' => 'ادخل الاسم بالانجليزية', 'icon' => 'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input', ['name' => 'ratio','type' =>'number', 'data' => $out->ratio, 'text' => 'نسبة العمولة', 'placeholder' => '%', 'icon' => 'fa-user-alt'])
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
