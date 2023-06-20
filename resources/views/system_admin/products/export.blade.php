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

    <h2>المنتجات</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم عربي</th>
                <th>الاسم إنجليزي</th>
                <th>التصنيف</th>
                <th>المصمم</th>
                <th>السعر</th>
                <th>الحالة</th>
                <th>تاريخ الاضافة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    {{-- <td>{{ $index+1 }}</td> --}}
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name_ar }}</td>
                    <td>{{ $product->name_en }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name_ar??'' }}</td>
                    <td>
                        @if ($product->has_discount)
                            <span class="old_price">{{ $product->real_price }}</span> <span
                                class="new_price">{{ $product->price }}
                                {{ \App\Models\Settings::get('currency_ar') }}</span>
                        @else
                            {{ $product->price }} {{ \App\Models\Settings::get('currency_ar') }}
                        @endif
                    </td>
                    @if ($product->is_active == 1)
                        <td>مفعل</td>
                    @else
                        <td>غير مفعل</td>
                    @endif
                    <td>{{ $product->created_at->toDateString() }}</td>

                </tr>
            @endforeach
        </tbody>


    </table>

</body>

</html>
