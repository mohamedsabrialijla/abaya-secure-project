<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
</head>

<body>

    <h2>الطلبات</h2>

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
                                        {{ @$o->order_id }}</a>
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
                                {{ $date_from }} -- {{ $date_to }}
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
        @else
            <div class="note note-info">
                <h4 class="block">لا يوجد بيانات مضافة</h4>
            </div>
        @endif

    </div>

</body>

</html>
