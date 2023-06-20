@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.products.index'), 'title' => 'المنتجات'],
    ]" />
@endsection
@section('page_content')




    @component('components.ShowCard', [
        'Disname' => 'المنتجات',
        'Disinfo' => 'ادارة المنتجات',
        'add_url' => 'system.products.create',
        'excel' => 'storeproductsexport',
        'module' => 'products',
        'store_id' => @$storeId,
        'actions' => [
        [
        'route' => 'system.products.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        [
        'route' => 'system.products.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.products.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
        ],
        ],
        ])
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">

                        @component('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'مفعل', 0 => 'معطل']])
                        @endcomponent
                        @component('components.serach.select', ['key' => 'category_id', 'text' => 'بحث حسب التصنيف', 'select' =>
                            $categories])
                        @endcomponent
                        @component('components.serach.input', ['type' => 'number', 'min' => 0, 'inputs' => ['price_from' =>
                            'السعر من', 'price_to' => 'السعر الى']])
                        @endcomponent
                        @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'اسم المنتج']])
                        @endcomponent

                        <a href="{{ route('system.products.index') }}" class="{{ config('layout.classes.delete') }} mb-4 ml-5">
                            <i class="fa fa-refresh"></i> تفريغ
                        </a>
                    </div>

                </form>
            </div>
        </div>

        @if (isset($out) && count($out) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>


                            <th>#</th>
                            <th width="5%" style="text-align: center;vertical-align: middle;">
                                <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                    <input type="checkbox" id="SelectAll">
                                    <span></span>
                                </label>


                            </th>
                            <th class="text-right">الإسم</th>
                            <th class="text-center">التصنيف</th>
                            <th class="text-center">المصمم</th>
                            <th class="text-center">السعر</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ الاضافة</th>
                            <th class="text-center">الإعدادات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($out as $o)
                            <tr id="TR_{{ $o->id }}">

                                <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                        <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                                            id="che_{{ $o->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-right">
                                    <img src="{{ $o->image_url }}" class="img_table" alt="">
                                    {{ $o->name }}
                                </td>
                                <td class="text-center"> {{ @$o->category->name }}</td>
                                <td class="text-center"> {{ @$o->store->name }}</td>
                                <td class="text-center">
                                    @if ($o->has_discount)
                                        <span class="old_price">{{ $o->real_price }}</span> <span
                                            class="new_price">{{ $o->price }}
                                            {{ \App\Models\Settings::get('currency_ar') }}</span>
                                    @else
                                        {{ $o->price }} {{ \App\Models\Settings::get('currency_ar') }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if (auth('system_admin')->user()->can('activate_products', 'system_admin'))
                                        <span class="switch switch-icon">
                                            <label>
                                                <input type="checkbox" class="productActive" id="is_active"
                                                    data-id="{{ $o->id }}" name="is_active"
                                                    {{ $o->is_active === 1 ? 'checked="checked"' : '' }} />
                                                <span></span>
                                            </label>
                                        </span>
                                    @else
                                        @if ($o->is_active == 1)
                                            <span class="m--font-success"> مفعل </span>
                                        @elseif($o->is_active == 0)
                                            <span class="m--font-warning"> غير مفعل </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center"> {{ @$o->created_at->toDateString() }}</td>
                                <td class="text-center">

                                    <ul class="list-inline">

                                        @if (auth('system_admin')->user()->can('edit_products', 'system_admin'))
                                            <li>

                                                @if ($o->is_feature == 0)
                                                    <button type="button"
                                                        class="{{ config('layout.classes.warning') }}  mt-2 update"
                                                        title="{{ $o->is_feature == 1 ? 'اخفاء المنتج من قائمة منتجات المميزة' : 'عرض المنتج في قائمة منتجات المميزة' }}"
                                                        data-ar="<?= $o->annotation_ar ?>" data-en="<?= $o->annotation_en ?>"
                                                        data-id="<?= $o->id ?>"
                                                        data-url="{{ route('system.featureProducts.update') }}"
                                                        data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top">
                                                        <i class="fa fa-gift "></i>

                                                        عرض
                                                    </button>
                                                @else
                                                    <button type="button" data-id="<?= $o->id ?>"
                                                        data-url="{{ route('system.featureProducts.change_show_feature_product') }}"
                                                        data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top"
                                                        title="{{ $o->is_feature == 1 ? 'اخفاء المنتج من قائمة منتجات المميزة' : 'عرض المنتج في قائمة منتجات المميزة' }}"
                                                        class="{{ config('layout.classes.edit') }} mt-2 btn-doAction">

                                                        <i class="fa fa-gift "></i>

                                                        اخفاء

                                                    </button>
                                                @endif

                                            </li>

                                            <li>

                                                @if ($o->show_in_slider == 0)
                                                    <button type="button"
                                                        class="{{ config('layout.classes.warning') }}  mt-2 updateSliderImage"
                                                        title="عرض المنتج في قائمة السلايدر" data-id="<?= $o->id ?>"
                                                        data-url="{{ route('system.featureProducts.update') }}"
                                                        data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top">
                                                        <i class="fa fa-gift "></i>

                                                        عرض
                                                    </button>
                                                @else
                                                    <button type="button" data-id="<?= $o->id ?>"
                                                        data-url="{{ route('system.sliderProducts.change_show_in_slider') }}"
                                                        data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                        data-theme="dark" data-placement="top"
                                                        title="{{ $o->show_in_slider == 1 ? 'اخفاء المنتج من قائمة منتجات السلايدر' : 'عرض المنتج في قائمة منتجات السلايدر' }}"
                                                        class="{{ config('layout.classes.edit') }} mt-2 btn-doAction">

                                                        <i class="fa fa-eye "></i>

                                                        اخفاء

                                                    </button>
                                                @endif

                                            </li>

                                            <li>


                                                <a class="{{ config('layout.classes.edit') }} mt-2"
                                                    href="{{ route('system.products.sizes', $o->id) }}">
                                                    <i class="fa fa-file "></i>
                                                    المقاسات
                                                </a>

                                            </li>
                                            <li>
                                                <a href="{{ route('system.products.update', $o->id) }}"
                                                    class="{{ config('layout.classes.edit') }} mt-2" data-toggle="tooltip"
                                                    data-theme="dark" title="تعديل البيانات">
                                                    <i class="fa fa-edit"></i> تعديل </a>
                                            </li>
                                        @endif
                                        @if (auth('system_admin')->user()->can('delete_products', 'system_admin'))
                                            <li>
                                                <button type="button" data-id="<?= $o->id ?>"
                                                    data-url="{{ route('system.products.delete') }}"
                                                    data-token="{{ csrf_token() }}" data-toggle="tooltip" data-theme="dark"
                                                    title="حذف" class="{{ config('layout.classes.delete') }}  mt-2 btn-del">
                                                    <i class="{{ config('layout.icons.delete_icon') }}"></i>
                                                    حذف
                                                </button>
                                            </li>
                                        @endif


                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- {!! $out->links() !!} --}}

            {!! $out->appends(Request::except('page'))->links() !!}
        @else
            <div class="note note-info">
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        @endif
    @endcomponent

    <div class="modal" id="updateFeature" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">تعديل</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">

                            @component('components.input', ['name' => 'annotation_ar', 'text' => 'نص المنتج المميز
                                بالعربية', 'not_req' => true, 'id' => 'annotation_ar'])
                            @endcomponent
                            <span class="text-danger" id="annotation_ar_error"></span>
                            @component('components.input', ['name' => 'annotation_en', 'text' => 'نص المنتج المميز
                                بالانجليزية', 'not_req' => true, 'id' => 'annotation_en'])
                            @endcomponent
                            <span class="text-danger" id="annotation_en_error"></span>
                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                            class="btn m-btn--pill m-btn--air btn-danger m-btn m-btn--custom  btn-action-7 feature">
                            <span>تعديل</span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="modal" id="updatesliderModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">عرض المنتج في السلايدر</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">
                            @csrf
                            @component('components.upload_image', ['name' => 'slider_image', 'text' => 'صورة الغلاف ', 'id'
                                => 'slider_image'])
                            @endcomponent
                            <span class="text-danger" id="slider_image_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                            class="btn m-btn--pill m-btn--air btn-primary m-btn m-btn--custom  btn-action-7 "
                            id="sliderImageUpdateBtn">
                            <span>عرض في السلايدر</span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('custom_scripts')
    <script>
        $(function() {
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price_from: {
                        number: true
                    },
                    price_to: {
                        number: true
                    }
                }
                /*,
                                message:{
                                   title: 'يجب ادخال ارقام فقط',
                                }*/
            }).init();


        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {

            $('.productActive').change(function() {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '{{ route('system.products.change_is_active') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'is_active': is_active,
                        'id': id
                    },
                    success: function(data) {

                    }
                });
            });


        });
    </script>

    <script>
        // var product_id = 0;

        $('.update').click(function() {

            let product_id = $(this).data('id');
            let AnnotationAr = $(this).data('ar');
            let AnnotationEn = $(this).data('en');

            feature(product_id, AnnotationAr, AnnotationEn);

        });
        $('.updateSliderImage').click(function() {

            let product_id = $(this).data('id');


            slider(product_id);

        });

        function slider(product_id) {

            $("#updatesliderModal").modal('show');

            $('#sliderImageUpdateBtn').click(function(e) {
                e.preventDefault();
                var slider_image = $('input[name=slider_image]').val();
                var token = '{{ csrf_token() }}';

                var url = '{{ route('system.slider.update') }}';

                $.post(url, {
                            _token: token,
                            id: product_id,
                            slider_image: slider_image,

                        },

                        function(data, status) {
                            if (data) {
                                $("#updatesliderModal").modal('hide');
                                location.reload();
                            } else {
                                alert('هناك خطأ ما');
                            }
                        })
                    .fail(function(data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function(key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        }); //end each
                    });

            });
        }

        function feature(product_id, AnnotationAr, AnnotationEn) {
            $('#annotation_ar').val(AnnotationAr);
            $('#annotation_en').val(AnnotationEn);
            $("#updateFeature").modal('show');

            $('.feature').click(function(e) {
                e.preventDefault();

                var annotation_ar = $('input[name=annotation_ar]');
                var annotation_en = $('input[name=annotation_en]');

                var token = '<?= csrf_token() ?>';

                var urll = '{{ route('system.featureProducts.update') }}';

                $.post(urll, {
                            _token: token,
                            id: product_id,
                            annotation_ar: annotation_ar.val(),
                            annotation_en: annotation_en.val(),

                        },

                        function(data, status) {

                            if (data) {
                                $("#updateFeature").modal('hide');
                                location.reload();

                            } else {

                                alert('هناك خطأ ما');

                            }

                        })
                    .fail(function(data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function(key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        }); //end each
                    });


            });
        }
    </script>
@endsection
