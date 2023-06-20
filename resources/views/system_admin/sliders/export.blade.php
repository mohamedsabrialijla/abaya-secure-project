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
  text-align: right;
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
    <th>الاسم عربي</th>
    <th>الاسم انجليزي</th>
    <th>رقم الجوال</th>
    <th>واتساب</th>
    <th>انستجرام</th>
    <th>سناب شات</th>
    <th>الحالة</th>
    <th>تاريخ التسجيل</th>
  </tr>
</thead>
<tbody>
  @foreach ($stores as $index=>$store)
  <tr>
    {{-- <td>{{ $index+1 }}</td> --}}
    <td>{{ $store->id }}</td>
    <td>{{ $store->name_ar }}</td>
    <td>{{ $store->name_en }}</td>
    <td>{{ $store->mobile }}</td>
    <td>{{ $store->whatsapp }}</td>
    <td>{{ $store->instagram }}</td>
    <td>{{ $store->snapchat }}</td>
    @if ($store->status == 1)
        <td>مفعل</td>
    @else
        <td>غير مفعل</td>
    @endif
    <td>{{ $store->created_at->toDateString() }}</td>

  </tr>
  @endforeach
</tbody>


</table>

</body>
</html>
