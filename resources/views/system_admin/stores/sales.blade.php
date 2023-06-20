@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'المصممون'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard',
        [
            'Disname' => 'المبيعات',
            'Disinfo' => 'ادارة المصممون',
            'module' => 'stores',
            'print' => '',
            'excel' => 'salesexport',
        ])
        <div class="row">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">


                            @component('components.serach.dateRanger')
                            @endcomponent

                            @component('components.serach.inputwithsearch', ['inputs' => []])
                            @endcomponent

                            <a href="{{ route('system.stores.sales', ['id' => $id]) }}"
                                class="{{ config('layout.classes.delete') }} mb-4 ml-5">
                                <i class="fa fa-refresh"></i> تفريغ
                            </a>

                        </div>

                    </div>

                </form>
            </div>

            <div class="col-lg-12" id="printarea">

                @if (isset($out) && count($out) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>


                                    <th>#</th>

                                    <th class="text-center">تاريخ الطلب</th>
                                    <th class="text-center">الموديل</th>
                                    <th class="text-center">رقم الطلب</th>
                                    <th class="text-center">عدد القطع</th>
                                    <th class="text-center">المقاس</th>
                                    <th class="text-center">السعر قبل الخصم</th>
                                    <th class="text-center">نسبة الخصم</th>
                                    <th class="text-center">قيمة الخصم</th>
                                    <th class="text-center">السعر بعد الخصم</th>
                                    <th class="text-center">طريقة السداد</th>
                                    <th class="text-center">نسبة عمولة البنك</th>
                                    <th class="text-center">قيمة عمولة السداد</th>
                                    <th class="text-center">إجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($out as $o)
                                    <tr id="TR_{{ $o->id }}">

                                        <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                        <td class="text-right">
                                            <p>
                                                {{ $o->order->created_at->toDateString() }}
                                            </p>


                                        </td>
                                        <td class="text-center">
                                            <p> {{ @$o->product->name_ar }}</p>
                                            {{-- <p> {{ @$o->product->name_en }}</p> --}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('system.orders.details', $o->order_id) }}">
                                                {{ @$o->order->invoice_number }}</a>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->qty }}</p>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->size->name_ar }}</p>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->price }}</p>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->discount_ratio ?? '0' }}</p>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->discount ?? '0' }} </p>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->total }}</p>
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->order->paymentType->name_ar }}</p>
                                            <p> {{ @$o->order->paymentType->name_en }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p> {{ @$o->order->paymentType->ratio }} %</p>
                                        </td>

                                        <td class="text-center">
                                            @if (@$o->order->paymentType->ratio > 0)
                                                <p>{{ (@$o->order->paymentType->ratio * @$o->total) / 100 }}</p>
                                            @else
                                                <p>0</p>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <p> {{ @$o->total - (@$o->order->paymentType->ratio * @$o->total) / 100 }}</p>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @php

                        $sum= $out->sum('total');
                        if ($com > 0) {
                            $tcom = ($sum * $com) / 100;
                        } else {
                            $tcom = 0;
                        }
                        $tax = 0;
                        foreach ($out as $key => $i) {
                            if ($i->order->paymentType->ratio > 0) {
                                $tax = ($i->order->paymentType->ratio * @$i->total) / 100 + $tax;
                            }
                        }

                        $total = $sum - $tcom - $tax;
                    @endphp
                    <div>
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>المصمم</th>
                                    <td>
                                        {{ $store->name_ar}} - {{  $store->name_en }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>التاريخ</th>
                                    <td>
                                        {{ request()->date_from }} -- {{ request()->date_to }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>الإجمالي</th>
                                    <td>
                                        {{ $sum }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>مصاريف إدارية</th>
                                    <td>{{ $tcom }}</td>
                                </tr>
                                <tr>
                                    <th>عمولات سداد</th>
                                    <td>{{ $tax }}</td>
                                </tr>
                                <tr class="table-active">
                                    <th>الصافي المستحق</th>
                                    <td>{{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (isset($out1) && count($out1) > 0)
                    <div>
                        <h4>الطلبات المرجعه</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>


                                        <th>#</th>

                                        <th class="text-center">تاريخ الطلب</th>
                                        <th class="text-center">الموديل</th>
                                        <th class="text-center">رقم الطلب</th>
                                        <th class="text-center">عدد القطع</th>
                                        <th class="text-center">المقاس</th>
                                        <th class="text-center">السعر قبل الخصم</th>
                                        <th class="text-center">نسبة الخصم</th>
                                        <th class="text-center">قيمة الخصم</th>
                                        <th class="text-center">السعر بعد الخصم</th>
                                        <th class="text-center">طريقة السداد</th>
                                        <th class="text-center">نسبة عمولة البنك</th>
                                        <th class="text-center">قيمة عمولة السداد</th>
                                        <th class="text-center">إجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($out1 as $o1)
                                        <tr id="TR_{{ $o1->id }}">

                                            <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                            <td class="text-right">
                                                <p>
                                                    {{ $o1->order->created_at->toDateString() }}
                                                </p>


                                            </td>
                                            <td class="text-center">
                                                <p> {{ @$o1->product->name_ar }}</p>
                                                {{-- <p> {{ @$o1->product->name_en }}</p> --}}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('system.orders.details', $o1->order_id) }}">
                                                    {{ @$o1->order->invoice_number }}</a>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->qty }}</p>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->size->name_ar }}</p>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->price }}</p>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->discount_ratio ?? '0' }}</p>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->discount ?? '0' }} </p>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->total }}</p>
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->order->paymentType->name_ar }}</p>
                                                <p> {{ @$o1->order->paymentType->name_en }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p> {{ @$o1->order->paymentType->ratio }} %</p>
                                            </td>

                                            <td class="text-center">
                                                @if (@$o1->order->paymentType->ratio > 0)
                                                    <p>{{ (@$o1->order->paymentType->ratio * @$o1->total) / 100 }}</p>
                                                @else
                                                    <p>0</p>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <p> {{ @$o1->total - (@$o1->order->paymentType->ratio * @$o1->total) / 100 }}</p>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="note note-info">
                        <h4 class="block">لا يوجد بيانات مضافة</h4>
                    </div>
                @endif

            </div>
        </div>
    @endcomponent

    <div class="modal  " id="designer-modal" data-backdrop="static">

        <div class="modal-dialog  modal-dialog-centered modal-lg">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title"> تفاصيل المصمم</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">




                </div>

            </div>

        </div>

    </div>

@endsection

@section('custom_scripts')
    <script>
        $("input[name=mobile]").keyup(function() {
            if ($(this)) {
                $(this).attr({
                    'pattern': '\\d*',
                    'title': "الرجاء ادخال ارقام فقط"
                });
            }
        });
    </script>

    <script>
        $('.show-designer-details').click(function() {


            let id = $(this).data('id');

            var token = '<?= csrf_token() ?>';

            var url = $(this).data('url');

            $.get(url, {
                    _token: token,
                    id: id,
                },
                function(data, status) {
                    if (data) {
                        $("#designer-modal .modal-body").html(data.details);
                        $("#designer-modal").modal('show');

                    } else {

                        Swal.fire("تنبيه", "يوجد خطأ ما", "warning")

                    }

                });
        });
    </script>


    <script>
        ClassicEditor
            .create(document.querySelector('#return_policy_ar'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontColor',
                        'alignment',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'exportPdf',
                        'exportWord'
                    ]
                },
                language: "ar",
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                editor.isReadOnly = true;







            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: xcs2esji16m9-tqzhsy8f19xk');
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#return_policy_en'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontColor',
                        'alignment',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'exportPdf',
                        'exportWord'
                    ]
                },
                language: "en",
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                editor.isReadOnly = true;







            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: xcs2esji16m9-tqzhsy8f19xk');
                console.error(error);
            });
    </script>
@endsection
