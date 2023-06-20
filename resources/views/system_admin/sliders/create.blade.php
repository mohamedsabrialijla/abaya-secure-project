@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.sliders.index'), 'title' => 'السلايدرز'],
    ]" />
@endsection

@section('page_content')

    @component('components.AddEditCard', [
        'Disname' => 'السلايدرز',
        'Disinfo' => 'اضافة سلايدر جديد',
        'add_url' => route('system.sliders.do.create'),
        'back_url' => 'system.sliders.index',
        'action' => 'add',
        ])
        <div class="row">
            <div class="col-md-6">
                @component('components.upload_image', ['name' => 'image', 'text' => 'صورة السلايدر', 'hint' => ''])
                @endcomponent
            </div>
            <div class="col-md-6 d-flex flex-stack mb-8">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-bold">قابل للنقر</label>
                    <div class="fs-7 fw-bold text-muted">إمكانية الانتقال الي منتجات السلايدر</div>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" name="clickable" type="radio" value="1" checked="checked">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>
                    <hr>
                    <input class="form-check-input" name="clickable" type="radio" value="0" checked="">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>
                </label>
                <!--end::Switch-->
            </div>
            <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">المنتجات</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار المنتجات" data-allow-clear="true" multiple="multiple" name="products[]">
                    <option></option>
                    @foreach ($products as $product)

                    <option value="{{ $product->id }}">{{ $product->name_ar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">الاقسام</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار القسم" data-allow-clear="true" multiple="multiple" name="cats[]">
                    <option></option>
                    @foreach ($cats as $cat)

                    <option value="{{ $cat->id }}">{{ $cat->name_ar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
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
