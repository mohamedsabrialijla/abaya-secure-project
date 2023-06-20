@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.products.index'), 'title' => 'الطلبات'],
    ]" />
@endsection
@section('page_content')


<!--ldklkdlgfkldhl-->
    @component('components.ShowCard', [
        'Disname' => 'الطلبات',
        'Disinfo' => 'مشاهدة الطلبات',
        'module' => 'products',
        'store_id' => @$storeId,
        'actions' => [
       
        ],
        ])
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">

                        @component('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'غير مدفوع', 0 => 'مدفوع']])
                        @endcomponent
                        
                        @component('components.serach.dateRanger')
                        @endcomponent
                        
                        @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'اسم الحالة']])
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


                            <th>رقم الفاتورة</th>
                            <th class="text-right">التاريخ</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">الحجم</th>
                            <th class="text-center">الزبون</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($out as $o)
                            <tr id="TR_{{ $o->id }}">
<!--dfjghdfk-->
                                <td class="LOOPIDS"><a href="{{url('admin/system/orders/details/'.$o->order->id)}}">{{ $o->order->invoice_number }}</a></td>
                               
                                <td class="text-right">
                                    {{ $o->order->created_at->format('Y-m-d') }}
                                </td>
                                <td class="text-center"> {{ @$o->order->status->name_ar }}</td>
                              
                                <td class="text-center"> {{ @$o->size->name }}</td>
                                <td class="text-center"> {{ @$o->order->customer->mobile }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


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
