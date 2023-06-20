@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
    ]" />
@endsection
@section('head')
    <style>
        .path-item {
            background: #eee;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: center;
            padding: 10px 20px;
        }

        .list-order .list-order-row {
            width: 60%;
            padding: 10px 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .list-order-total {
            width: 100%;
            padding: 10px 0;
            border-top: 3px solid #f2f2f2;
        }

        .list-order-total div {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            width: 60%;
            font-weight: 700;
        }

        .list-order .list-order-row span {
            font-weight: 700;
            display: inline-block;
            color: #4d565c;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            right: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
            padding-right: 20px;
        }

        ul.timeline>li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            right: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }

    </style>

@endsection

@section('page_content')
    <div class="row">
        <div class="col-xl-6 col-12">

            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            بيانات الطلب
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">

                            <a href="{{ $order->invoice_url }}" target="_blank" class="btn btn-black btn-sm">
                                <i class="la la-print la-3x "></i>
                            </a>



                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="m-content">
                        <div class="order-data">

                            <div class="form-group row mb-3">
                                <label class="col-sm-3">رقم الطلب</label>
                                <div class="col-sm-9">
                                    <p>#{{ $order->invoice_number }}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3">تاريخ الطلب</label>
                                <div class="col-sm-9">

                                    <span class="calendar">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>

                                        {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}

                                        <i class="fa fa-clock" aria-hidden="true"></i>

                                        {{ \Carbon\Carbon::parse($order->created_at)->format('H:i A') }}

                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3">طريقة الدفع</label>
                                <div class="col-sm-9">
                                    <span>
                                        {{ @$order->paymentType->name }}
                                    </span>
                                    &nbsp; &nbsp;
                                    @if ($order->payment_type_id != 4 && $order->use_wallet)
                                        استخدم رصيد محفظة ({{ $order->wallet_amount }})
                                    @endif

                                </div>
                            </div>


                            @if ($order->transaction && $order->transaction->tranid)
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3"> الرقم المرجعي : </label>
                                    <div class="col-sm-9">
                                        <span>
                                            {{ @$order->transaction->tranid }}
                                        </span>
                                        &nbsp;
                                    </div>
                                </div>
                            @endif

                            @if ($order->payment_type_id == '10')
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3"> الرقم المرجعي : </label>
                                    <div class="col-sm-9">
                                        <span>
                                            {{ @$order->tamara }}
                                        </span>
                                        &nbsp;
                                    </div>
                                </div>
                            @endif


                            <!--@if ($order->payment_type_id == '3' || $order->payment_type_id == '2')-->
                            <!--    <div class="form-group row mb-3">-->
                            <!--        <label class="col-sm-3">3 الرقم المرجعي : </label>-->
                            <!--        <div class="col-sm-9">-->
                            <!--            <span>-->
                            <!--                {{ @$order->reference_number }}-->
                            <!--            </span>-->
                            <!--            &nbsp;-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--@endif-->




                            <div class="form-group row mb-3">
                                <label class="col-sm-3">حالة الطلب</label>
                                <div class="col-sm-9">
                                    <div class="order-status-btn">
                                        {{ @$order->status->name }}
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($order->shipment_id)
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">رقم الشحنة</label>
                                    <div class="col-sm-9">
                                        <div class="order-status-btn">
                                            {{ @$order->shipment_id }}
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 "> العمليات</label>
                                <div class="col-sm-9">
                                    <div class="order-status-btn">
                                        @if (auth('system_admin')->user()->can('edit_orders', 'system_admin'))
                                            @if ($order->case_id == 1)
                                                <button class="{{ config('layout.classes.add') }} btn-action">
                                                    تأكيد
                                                </button>
                                            @elseif($order->case_id == 3)
                                                <button class="{{ config('layout.classes.add') }} btn-action">
                                                    جاري الشحن
                                                </button>
                                            @elseif($order->case_id == 4)
                                                <button class="{{ config('layout.classes.add') }} btn-action">
                                                    تم الشحن
                                                </button>
                                            @elseif($order->case_id == 5)
                                                <button class="{{ config('layout.classes.add') }} btn-action">
                                                    جاري التوصيل
                                                </button>
                                            @elseif($order->case_id == 6)
                                                <button class="{{ config('layout.classes.add') }} btn-action">
                                                    تم التوصيل
                                                </button>
                                            @elseif($order->case_id == 7)
                                                <button class="{{ config('layout.classes.add') }} btn-action">
                                                    مسترجع
                                                </button>
                                            @elseif($order->case_id == 2)
                                                <span>ملغي</span>
                                            @elseif($order->case_id == 8)
                                                <span>مرجع</span>
                                            @endif

                                            @if ($order->case_id != 8 && $order->case_id != 7 && $order->case_id != 2)
                                                <button class="{{ config('layout.classes.delete') }} btn-action-6"> ملغي
                                                </button>
                                            @endif
                                        @endif

                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-6 col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            بيانات الزبون
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">

                            <a href="{{ route('system.orders.index', ['status' => Str::lower($order->status->name_en)]) }}"
                                class="{{ config('layout.classes.black') }} m-2">
                                <i class="la la-arrow-right"></i>
                                رجوع
                            </a>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="m-content">
                        <div class="order-data">
                            <form>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">اسم الزبون</label>
                                    <div class="col-sm-9">
                                        <p> {{ @$order->customer->name }}</p>
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">جوال الزبون</label>
                                    <div class="col-sm-9">
                                        <p dir="ltr"> {{ @$order->customer->mobile }} </p>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">ايميل الزبون</label>
                                    <div class="col-sm-9">
                                        <p dir="ltr"> {{ @$order->customer->email }} </p>
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">عنوان تسليم الطلب</label>
                                    <div class="col-sm-9" dir="rtl">
                                        <p> الاسم :{{ @$order->address->name }} </p>
                                        <p> العنوان :{{ @$order->address->address }} </p>
                                        <p> الجوال :{{ @$order->mobile }} </p>
                                        <p> المدينة :{{ @$order->address->area->name }} </p>
                                        <p> العنوان على الخريطة :<span class="fa fa-globe show-map pointer-event"></span>
                                        </p>
                                        

                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <br />
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            منتجات الطلب
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">


                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>صورة المنتج</th>
                                    <th>اسم المصمم</th>
                                    <th>اسم المنتج</th>
                                    <th>المقاس</th>
                                    <th>الكمية</th>
                                    <th>السعر({{ @$currency }})</th>
                                    <th>الخصم({{ @$currency }})</th>
                                    <th>المجموع({{ @$currency }})</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset('uploads/' . @$product->product->image) }}" width="70"
                                                height="70" /></td>
                                        <td>{{ @$product->product->store->name }}</td>
                                        <td>{{ @$product->product->name }}</td>
                                        <td>{{ @$product->size->name }}</td>
                                        <td>{{ @$product->qty }}</td>
                                        <td>{{ @$product->price }}</td>
                                        <td>{{ @$product->discount }}</td>
                                        <td>{{ @$product->total }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            الملخص الاجمالي
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>


                </div>

                <div class="card-body">


                    <div class="list-order">
                        <div class="list-order-row">
                            <label>
                                اجمالي سعر المنتجات :
                            </label>
                            <span>
                                {{ $order->sub_total_1 }} <span>{{ $currency }}</span>
                            </span>
                        </div>
                        <div class="list-order-row">
                            <label>
                                ض.ق.م
                            </label>
                            <span>
                                {{ @$order->tax }} <span>{{ $currency }}</span>
                            </span>
                        </div>
                        <div class="list-order-row">
                            <label>
                                قيمة الخصم
                                @if ($order->discount && $order->promo_code)
                                    ( كود ترويجي )
                                @elseif($order->discount)
                                    (كوبون مصمم)
                                @endif

                            </label>
                            <span>
                                {{ @$order->discount }} <span>{{ $currency }}</span>
                            </span>
                        </div>
                        <div class="list-order-row">
                            <label>
                                رسوم التوصيل :
                            </label>
                            <span>
                                {{ $order->delivery_cost }} <span>{{ $currency }}</span>
                            </span>
                        </div>

                        @if ($order->replaced == 1)
                        <div class="list-order-row">
                            <label>
                                رسوم الاستبدال :
                            </label>
                            <span>
                                {{ $order->replacement_fee }} <span>{{ $currency }}</span>
                            </span>
                        </div>
                        @endif

                    </div>

                    <div class="list-order-total">
                        <div>
                            <label>
                                الإجمالي الكلي
                            </label>
                            <span>
                                {{ $order->total }} <span>{{ $currency }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="list-order">

                        @if ($order->use_wallet)
                            <div class="list-order-row">
                                <label>
                                    رصيد المحفظة المستخدم :
                                </label>
                                <span>
                                    {{ $order->wallet_amount }} <span>{{ $currency }}</span>
                                </span>
                            </div>
                        @endif


                        @if ($order->payment_type_id == 1)
                            <div class="list-order-row">
                                <label>
                                    المبلغ للدفع :
                                </label>
                                <span>
                                    {{ $order->cod_amount ?? 0 }} <span>{{ $currency }}</span>
                                </span>
                            </div>
                        @endif




                        @if ($order->transaction)
                            <div class="list-order-row">
                                <label>
                                    رصيد المدفوع :
                                </label>
                                <span>
                                    {{ $order->transaction->amount }} <span>{{ $currency }}</span>
                                </span>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
        <div class="col-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            سجل الطلب
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>


                </div>

                <div class="card-body">


                    <ul class="timeline">

                        @foreach ($activityLog as $log)
                            <li>
                                <a href="javascript:;">{{ @$log->case->name }}</a>
                                <a href="javascript:;" class="float-right">
                                    {{ \Carbon\Carbon::parse(@$log->created_at)->translatedFormat('D jS M Y g:i a') }}
                                </a>
                                <p>{{ @$log->case->details }}</p>
                            </li>
                        @endforeach

                    </ul>


                </div>

            </div>
        </div>
    </div>



    <div class="modal" id="map-modal" data-backdrop="static">
        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title">الموقع</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">

                        <div class="col-md-12" id="map" style="width:400px;  height: 400px;"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection





@section('custom_scripts')
    <script>
    //adfafsaf
        $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
        $(function() {
            $('.btn-action').click(function(e) {
                e.preventDefault();

                swal.fire({
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد تغيير حالة الطلب الطلب",
                    type: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتغيير !",
                    cancelButtonText: "لا, الغي العملية !",
                    reverseButtons: 1
                }).then(function(e) {

                    if (e.value) {
                        var token = '<?= csrf_token() ?>';
                        var url = '{{ route('system.orders.change_status') }}';
                        var order = <?= $order->id ?>;
                        $.post(url, {
                                _token: token,
                                id: order
                            },
                            function(data, status) {
                                if (data.done == true) {
                                    if (data.title) {
                                        swal.fire(data.title, data.message, "info").then(() => {
                                            location.reload();
                                        })
                                    }
                                    swal.fire("تم تنفيذ العملية", "تم تغيير الحالة بنجاح",
                                        "success").then(() => {
                                        location.reload();
                                    })

                                } else {
                                    if (data.message) {
                                        swal.fire("خطأ", data.message, "error");
                                    } else {
                                        swal.fire("هناك خطأ ما", '', "error");

                                    }

                                }
                            });

                    } else {
                        e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");

                    }
                });


            });
            $('.btn-action-6').click(function() {

                swal.fire({
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد الغاء الطلب",
                    type: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتغيير !",
                    cancelButtonText: "لا, الغي العملية !",
                    reverseButtons: 1
                }).then(function(e) {

                    if (e.value) {
                        var token = '<?= csrf_token() ?>';
                        var url = '{{ route('system.orders.change_order_status_to_can') }}';
                        var order = <?= $order->id ?>;
                        $.post(url, {
                                _token: token,
                                id: order,
                            },
                            function(data, status) {
                                if (data.done == true) {
                                    swal.fire("تم تنفيذ العملية", "تم تغيير الحالة بنجاح",
                                        "success").then(() => {
                                        location.reload();
                                    })
                                } else {
                                    alert('هناك خطأ ما');
                                }
                            });

                    } else {
                        e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");

                    }
                });


            });

        })
    </script>


    <script>
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: {{ $order->address->lat }},
                lng: {{ $order->address->lng }}
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpxsc_JdZZRhNV6hOs8BPmO63hXZNB3w4&callback=initMap&libraries=&v=weekly"
        async></script>

    <script>
        $('.show-map').click(function() {

            $("#map-modal").modal('show');
        });
    </script>
@endsection
