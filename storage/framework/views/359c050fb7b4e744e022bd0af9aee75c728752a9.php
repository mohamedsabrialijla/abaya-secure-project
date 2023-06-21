
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
  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    
    <td><?php echo e($customer->id); ?></td>
    <td><?php echo e($customer->name); ?></td>
    <td><?php echo e($customer->email); ?></td>
    <td><?php echo e($customer->mobile); ?></td>
    <?php if($customer->status == 1): ?>
        <td>مفعل</td>
    <?php else: ?>
        <td>غير مفعل</td>
    <?php endif; ?>
    <td><?php echo e($customer->created_at->toDateString()); ?></td>
    <td><?php echo e($customer->last_login); ?></td>
    <td><?php echo e($customer->wallet); ?></td>
    <td><?php echo e($customer->points); ?></td>

  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>


</table>

</body>
</html>
<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/customers/export.blade.php ENDPATH**/ ?>