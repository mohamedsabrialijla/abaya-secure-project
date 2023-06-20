@extends('layouts.admin')

@section('head')
    <style>
        .orders_new_content {
            text-align: center;
            border: 1px solid #eee;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
            width: 100%;
            font-size: 14px !important;
            /*min-width: 300px;*/
        }

        .status_title {
            padding: 12px;
            border-bottom: 4px solid #eee;
            background: #1E1E2D;
            color: #fff;
        }

        .order_item {
            border: 2px solid #eee;
            margin: 10px;
            /*border-radius: 10px;*/
            display: flex;
            justify-content: center;
            align-items: stretch;
            flex-wrap: wrap;
        }

        .rightCont {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding: 5px;
            width: 60px;
            border: 1px solid #eee;
            border-radius: 0 0 10px 10px;
            -ms-flex-line-pack: center !important;
            align-content: center !important;
            -webkit-box-pack: center !important;
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .centerCont {
            /*padding: 10px;*/
            width: calc(100% - 60px);
        }

        .centerCont .details {
            text-align: right;
        }

        .centerCont .details p {
            padding: 0;
            margin: 0;
        }

        .leftCont {
            padding: 10px;
            width: 100px;
            border: 1px solid #eee;
            border-radius: 0 0 10px 10px;
        }

        .titleCont {
            padding: 10px;
            width: 100%;
            border-bottom: 2px solid #eee;
            /*display: flex;*/
            /*justify-content: center;*/
            /*align-items: center;*/
            /*flex-wrap: wrap;*/
        }

        .new_actions {
            display: flex;
            justify-content: space-between;
        }

        .new_actions .btn {
            margin: 5px 20px;
            padding: 5px 15px;
        }

        /*.right{*/
        /*    text-align: right;*/
        /*    width: 40%;*/
        /*}*/
        .left {
            text-align: left;
            width: 100%;
        }

        .price {
            text-align: center;
            color: #883158;
            font-weight: 600;
            width: 100%;
        }

        .centerContHidden {
            padding: 10px;
            width: 100%;
            display: none;
        }

        .centerContHidden .details {
            text-align: right;
        }

        .centerContHidden .details p {
            padding: 0;
            margin: 0;
        }

        .myTable {
            width: 100%;
            margin: 5px 0;
        }

        .myTable td {
            padding: 2px 5px 2px;
            border-bottom: 1px solid #eee;
        }

        .myTable tr:last-child td {
            border-bottom: 0;
        }

        @media screen and (max-width: 1370px) {
            :root {
                font-size: 13px;
            }

            .centerCont {

                width: 100%;
            }

            .rightCont {
                padding: 10px;
                width: 100%;
                border: 1px solid #eee;
                border-radius: 0;
            }

            /*.right {*/
            /*    text-align: right;*/
            /*    width: 40%;*/
            /*}*/
            /*.left {*/
            /*    text-align: left;*/
            /*    width: 60%;*/
            /*}*/
        }

        @media screen and (max-width: 1024px) {
            :root {
                font-size: 12px;
            }

            .centerCont {

                width: 100%;
            }

            .rightCont {
                padding: 10px;
                width: 100%;
                border: 1px solid #eee;
                border-radius: 0;
            }

        }

        @media screen and (max-width: 768px) {
            :root {
                font-size: 12px;
            }
        }

        @media screen and (max-width: 480px) {
            :root {
                font-size: 11px;
            }

            /*.right{*/
            /*    text-align: center;*/
            /*    width: 100%;*/
            /*}*/
            /*.left{*/
            /*    text-align: center;*/
            /*    width: 100%;*/
            /*}*/
            .price {
                text-align: center;
                color: #883158;
                font-weight: 600;
                width: 100%;
            }

            .rightCont {
                padding: 10px;
                width: 100%;
                border: 1px solid #eee;
                border-radius: 0;
            }


        }

    </style>
@endsection


@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard',
        [
            'Disname' => 'الطلبات بحالة ' . @$case_name->name,
            'Disinfo' => 'ادارة الطلبات بحالة " ' . @$case_name->name . ' " في الموقع',
            'module' => 'orders',
            'excel' => 'ordersexport',
            'actions' => [],
        ])
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            <input type="hidden" name="status" value="{{ @Str::lower($status) }}">

                            @component('components.serach.dateRanger')
                            @endcomponent
                            @component('components.serach.input', ['type' => 'number', 'min' => 0, 'inputs' => ['price_from' => 'السعر من', 'price_to' => 'السعر الى']])
                            @endcomponent
                            @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'رقم الفاتورة']])
                            @endcomponent

                            <a href="{{ route('system.orders.index', ['status' => @$status]) }}"
                                class="{{ config('layout.classes.delete') }} mb-4 ml-5">
                                <i class="fa fa-refresh"></i> تفريغ
                            </a>

                        </div>
                    </div>


                </form>
            </div>
        </div>
        <div class="row justify-content-center align-content-stretch">
            @if (isset($out) && count($out) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>


                                <th>#</th>
                                {{-- <th width="5%" style="text-align: center;vertical-align: middle;"> --}}
                                {{-- <label class="checkbox checkbox-outline justify-content-center checkbox-success"> --}}
                                {{-- <input type="checkbox" id="SelectAll"> --}}
                                {{-- <span></span> --}}
                                {{-- </label> --}}

                                {{-- </th> --}}
                                <th class="text-center"> الطلب من </th>
                                <th class="text-center"> رقم الطلب</th>
                                <th class="text-center"> الزبون </th>
                                <th class="text-center"> عدد المنتجات </th>
                                <th class="text-center"> الكمية </th>
                                <th class="text-center"> طريقة الدفع </th>
                                <th class="text-center"> السعر الاجمالي </th>
                                <th class="text-center">تاريخ الطلب</th>
                                <th class="text-center">الإعدادات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($out as $o)
                                <tr id="TR_{{ $o->id }}">

                                    <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                    {{-- <td style="text-align: center;vertical-align: middle;"> --}}
                                    {{-- <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table"> --}}
                                    {{-- <input type="checkbox" value="{{ $o->id}}" name="Item[]" --}}
                                    {{-- class="CheckedItem" id="che_{{$o->id}}"> --}}
                                    {{-- <span></span> --}}
                                    {{-- </label> --}}
                                    {{-- </td> --}}
                                    <td>
                                        @if($o->created_at > '2023-03-04')
                                            @if($o->order_from != '') الموقع  @else تطبيق  @endif
                                        @else
                                            قديم
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('system.orders.details', $o->id) }}"
                                            style="line-height: 25px;font-weight: bold">
                                            <span>{{ $o->invoice_number }}</span>

                                        </a>
                                    </td>

                                    <td class="text-center">

                                        @if (!is_null($o->customer))

                                        @if ($o->customer->name)
                                            {{ $o->customer->name }}
                                        @elseif($o->customer->mobile)
                                            {{ $o->customer->mobile }}
                                        @elseif($o->customer->email)
                                            {{ $o->customer->email }}
                                        @endif
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        {{ @$o->products()->count() }}
                                    </td>
                                    <td class="text-center">
                                        {{ @$o->products()->sum('qty') }}
                                    </td>
                                    <td class="text-center">
                                        {{ @$o->paymentType->name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $o->total }} {{ \App\Models\Settings::get('currency_ar') }}
                                    </td>
                                    <td class="text-center"> {{ @$o->created_at->toDateString() }}</td>
                                    <td class="text-center">
                                        <ul class="list-inline">

                                            @if (auth('system_admin')->user()->can('edit_orders', 'system_admin') ||
                                                auth('system_admin')->user()->can('view_orders', 'system_admin'))

                                                <li>
                                                    <a href="{{ route('system.orders.details', $o->id) }}"
                                                        class="{{ config('layout.classes.edit') }} mt-2"
                                                        data-toggle="tooltip" data-theme="dark" title="عرض">
                                                        <i class="fa fa-desktop"></i> عرض </a>
                                                </li>
                                            @endif
                                            @if (auth('system_admin')->user()->can('edit_orders', 'system_admin'))
                                                <li>
                                                    <a href="{{ route('system.orders.edit', $o->id) }}"
                                                        class="{{ config('layout.classes.edit') }} mt-2"
                                                        data-toggle="tooltip" data-theme="dark" title="تعديل">
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                            @endif
                                            @if (auth('system_admin')->user()->can('delete_orders', 'system_admin'))
                                                <li>

                                                    <button class="{{ config('layout.classes.delete') }} mt-2 btn-del"
                                                        data-id="<?= $o->id ?>" data-toggle="tooltip" data-theme="dark"
                                                        data-url="{{ route('system.orders.delete') }}"
                                                        data-token="{{ csrf_token() }}" title="حذف"><i
                                                            class="fa fa-trash"> </i>حذف
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
            @else
                <div class="note note-info">
                    <h5 class="block">لا يوجد بيانات للعرض</h5>
                </div>
            @endif

        </div>
        <div class="clearfix"></div>

        <div class="row mt-5 justify-content-center">
            {!! $out->appends(Request::except('page'))->links() !!}
        </div>
    @endcomponent

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
                        number: true,
                        lessThan: '#price_to'
                    },
                    price_to: {
                        number: true,
                        greaterThan: '#price_from'

                    },
                    date_from: {
                        dateFormat: 'mm/dd/yy',
                        required: false,
                        date: true,
                        dateITA: true,
                        maxDate: '#date_to',
                        dateLessThan: '#date_to'
                    },
                    date_to: {
                        dateFormat: 'mm/dd/yy',
                        required: false,
                        date: true,
                        dateITA: true,
                        minDate: '#date_from',
                        dateGreaterThan: "#date_from"
                    }
                }
                /*,
                                message: {
                                    title: 'يجب ادخال ارقام فقط',
                                }*/
            }).init();


        });
    </script>



    <script>

        $(".btn-del2").click(function() {

            var Id = $(this).data('id');
            var ONUM = $(this).data('onum');
            var url = $(this).data('url');
            var token = $(this).data('token');
            var thisF = $(this);
            swal.fire({

                title: "هل انت متأكد ؟",
                text: "هل تريد بالتأكيد حذف الطلب رقم " + ONUM,
                type: "warning",
                showCancelButton: 1,
                confirmButtonText: "نعم , قم بالحذف !",
                cancelButtonText: "لا, الغي العملية !",
                reverseButtons: 1
            }).then(function(e) {
                if (e.value) {
                    $.post(url, {
                            _token: token,
                            id: Id,
                        },
                        function(data, status) {
                            if (data.done == true) {
                                swal.fire({
                                    title: 'تم الحذف بنجاح',
                                    text: data.msg,
                                    type: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(
                                    function() {
                                        var d = thisF.parents('.order_item2');
                                        d.css('background', '#f00').fadeOut(600, function() {
                                            d.remove();
                                        });
                                    }
                                )
                            } else if (data.done == false) {
                                swal.fire({
                                    title: 'حدث خطأ ؛ لا يمكن حذف الطلب',
                                    text: data.msg,
                                    icon: 'error',
                                    type: 'error',
                                    timer: 4000,
                                    showConfirmButton: false
                                })
                            }
                        }).fail(function(data2, status) {
                        var data2 = data2.responseJSON;
                        swal.fire({
                            title: 'خطأ',
                            text: data2.response_message,
                            type: 'error',
                            timer: 4000,
                            showConfirmButton: false
                        })
                    });
                } else {
                    e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");
                }
            });
        });
    </script>
@endsection
