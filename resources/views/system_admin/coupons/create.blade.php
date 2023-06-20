@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.coupons.index'), 'title' => 'كبونات الخصم'],
    ]" />
@endsection

@section('page_content')

    @component('components.AddEditCard', [
        'Disname' => 'كبونات الخصم',
        'Disinfo' => 'اضافة كبون خصم جديد',
        'add_url' => route('system.coupons.do.create'),
        'back_url' => 'system.coupons.index',
        'action' => 'add',
        ])
        <div class="row">

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input', ['name' => 'code', 'text' => 'الكود', 'placeholder' => 'ادخل الكود'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.switch', ['name' => 'is_active', 'text' => 'حالة الكود'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input', ['name' => 'discount_ratio', 'text' => 'نسبة او قيمة الخصم', 'icon' => 'fa-percent'])
                @endcomponent
            </div>

            <div class="col-md-6 d-flex flex-stack mb-8">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-bold">طريقة الخصم</label>
                    <div class="fs-7 fw-bold text-muted">اختيار طريقة الخصم اما نسبة مئوية او مبلغ محدد</div>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" name="flag" type="radio" value="1" checked="checked">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نسبة مئوية</span></div>
                    <hr>
                    <input class="form-check-input" name="flag" type="radio" value="2" checked="">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">مبلغ محدد</span></div>
                    <hr>
                    <input class="form-check-input" name="flag" type="radio" value="3" checked="">
                    <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">خصم قيمة الشحن</span></div>
                </label>
                <!--end::Switch-->
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input', ['name' => 'limit', 'text' => 'الحد الادني لقيمة الطلب لتفعيل الكوبون', 'icon' => 'fa-dollar'])
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('components.switch', ['name' => 'show', 'text' => 'ظهور الكوبون تحت المنتج '])
                @endcomponent
            </div>

            <div class="w-100"></div>

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
                    <span class="required">المنتجات بدلالة الأقسام</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار القسم" data-allow-clear="true" multiple="multiple" name="cats[]">
                    <option></option>
                    @foreach ($cats as $cat)

                    <option value="{{ $cat->id }}">{{ $cat->name_ar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-100"></div>

            <div class="col-md-6 d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">المنتجات بدلالة المصممين</span>

                </label>
                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختار المصمم" data-allow-clear="true" multiple="multiple" name="stores[]">
                    <option></option>
                    @foreach ($stores as $store)

                    <option value="{{ $store->id }}">{{ $store->name_ar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                @component('components.input', ['name' => 'count_of_use', 'text' => 'عدد مرات الاستخدام'])
                @endcomponent
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.datepicker', ['name' => 'start_date', 'text' => 'تاريخ البداية'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.datepicker', ['name' => 'expire_date', 'text' => 'تاريخ الانتهاء'])
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

        $('#start_date').datepicker();
        $('#expire_date').datepicker();
    </script>
@endsection
