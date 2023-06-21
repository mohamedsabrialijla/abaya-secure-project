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
  <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    
    <td><?php echo e($store->id); ?></td>
    <td><?php echo e($store->name_ar); ?></td>
    <td><?php echo e($store->name_en); ?></td>
    <td><?php echo e($store->mobile); ?></td>
    <td><?php echo e($store->whatsapp); ?></td>
    <td><?php echo e($store->instagram); ?></td>
    <td><?php echo e($store->snapchat); ?></td>
    <?php if($store->status == 1): ?>
        <td>مفعل</td>
    <?php else: ?>
        <td>غير مفعل</td>
    <?php endif; ?>
    <td><?php echo e($store->created_at->toDateString()); ?></td>

  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>


</table>

</body>
</html>
<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/export.blade.php ENDPATH**/ ?>