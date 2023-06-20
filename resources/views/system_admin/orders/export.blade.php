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

    <table>
        <thead>
            <tr>
                <th>رقم الطلب</th>
                <th>تاريخ الطلب</th>
                <th>طريقة الدفع</th>
                <th>الرقم المرجعي</th>
                <th>حالة الطلب</th>
                <th>رقم الشحنة</th>
                <th>اسم الزبون</th>
                <th>جوال الزبون</th>
                <th>ايميل الزبون</th>
                <th>عنوان تسليم الطلب</th>
                <th>عدد المنتجات</th>
                <th>الكمية</th>
                <th>الاجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ $order->invoice_number }}</td>
                    <td>
                        <i class="fa fa-calendar" aria-hidden="true"></i>

                        {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}

                        <i class="fa fa-clock" aria-hidden="true"></i>

                        {{ \Carbon\Carbon::parse($order->created_at)->format('H:i A') }}
                    </td>
                    <td>
                        <span>
                            {{ @$order->paymentType->name }}
                        </span>
                        &nbsp; &nbsp;
                        @if ($order->payment_type_id != 4 && $order->use_wallet)
                            استخدم رصيد محفظة ({{ $order->wallet_amount }})
                        @endif
                    </td>
                    <td>{{ $order->transaction->tranid??'' }}</td>
                    <td>{{ $order->status->name??'' }}</td>
                    <td>{{ $order->shipment_id??'' }}</td>
                    <td>{{ $order->customer->name??'' }}</td>
                    <td>{{ $order->customer->mobile??'' }}</td>
                    <td>{{ $order->customer->email??'' }}</td>
                    <td>
                        <p> الاسم :{{@$order->address->name}} </p>
                        <p> العنوان :{{@$order->address->address}} </p>
                        <p> الجوال :{{@$order->mobile}} </p>
                    </td>
                    <td> {{ $order->products()->count() }}</td>
                    <td> {{ $order->products()->sum('qty') }}</td>
                    <td> {{ $order->total }}</td>
                </tr>
            @endforeach
        </tbody>


    </table>

</body>

</html>
