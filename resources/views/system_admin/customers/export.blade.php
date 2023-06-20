
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>الزبائن</h2>

<table>
    <thead>
  <tr>
    <th>#</th>
    <th>الاسم</th>
    <th>البريد الإلكتروني</th>
    <th>رقم الجوال</th>
    <th>الحالة</th>
    <th>تاريخ التسجيل</th>
    <th>اخر دخول</th>
    <th>المحفظة</th>
    <th>النقاط</th>
  </tr>
</thead>
<tbody>
  @foreach ($customers as $index=>$customer)
  <tr>
    {{-- <td>{{ $index+1 }}</td> --}}
    <td>{{ $customer->id }}</td>
    <td>{{ $customer->name }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ $customer->mobile }}</td>
    @if ($customer->status == 1)
        <td>مفعل</td>
    @else
        <td>غير مفعل</td>
    @endif
    <td>{{ $customer->created_at->toDateString() }}</td>
    <td>{{ $customer->last_login }}</td>
    <td>{{ $customer->wallet }}</td>
    <td>{{ $customer->points }}</td>

  </tr>
  @endforeach
</tbody>


</table>

</body>
</html>
