<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td{

            text-align: right;
            padding: 8px;
            width: 10cm;
        },
        th {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
            width: 10cm;
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
                <th>#ID</th>
                <th>Name</th>
                <th>Size</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($out as $index => $item)
            @foreach($item->stock()->orderBy('created_at','desc')->get() as $key=>$stock)
                <tr>
                    <td>{{ $stock->productSize->product->id }}</td>
                    <td>{{ $stock->productSize->product->name_ar }}</td>
                    <td>{{ $stock->productSize->size->name }}</td>
                    <td>{{ $stock->qty }}</td>
                    <br>

                </tr>
                @endforeach
            @endforeach
        </tbody>


    </table>

</body>

</html>
