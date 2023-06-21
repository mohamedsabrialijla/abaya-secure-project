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
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($order->invoice_number); ?></td>
                    <td>
                        <i class="fa fa-calendar" aria-hidden="true"></i>

                        <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')); ?>


                        <i class="fa fa-clock" aria-hidden="true"></i>

                        <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('H:i A')); ?>

                    </td>
                    <td>
                        <span>
                            <?php echo e(@$order->paymentType->name); ?>

                        </span>
                        &nbsp; &nbsp;
                        <?php if($order->payment_type_id != 4 && $order->use_wallet): ?>
                            استخدم رصيد محفظة (<?php echo e($order->wallet_amount); ?>)
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($order->transaction->tranid??''); ?></td>
                    <td><?php echo e($order->status->name??''); ?></td>
                    <td><?php echo e($order->shipment_id??''); ?></td>
                    <td><?php echo e($order->customer->name??''); ?></td>
                    <td><?php echo e($order->customer->mobile??''); ?></td>
                    <td><?php echo e($order->customer->email??''); ?></td>
                    <td>
                        <p> الاسم :<?php echo e(@$order->address->name); ?> </p>
                        <p> العنوان :<?php echo e(@$order->address->address); ?> </p>
                        <p> الجوال :<?php echo e(@$order->mobile); ?> </p>
                    </td>
                    <td> <?php echo e($order->products()->count()); ?></td>
                    <td> <?php echo e($order->products()->sum('qty')); ?></td>
                    <td> <?php echo e($order->total); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>


    </table>

</body>

</html>
<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/orders/export.blade.php ENDPATH**/ ?>