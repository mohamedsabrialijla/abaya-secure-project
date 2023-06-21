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

        <?php if(isset($out) && count($out) > 0): ?>
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
                        <?php $__currentLoopData = $out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="TR_<?php echo e($o->id); ?>">

                                <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
                                <td class="text-right">
                                    <p>
                                        <?php echo e($o->order->created_at->toDateString()); ?>

                                    </p>


                                </td>
                                <td class="text-center">
                                    <p> <?php echo e(@$o->product->name_ar); ?></p>
                                    
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('system.orders.details', $o->order_id)); ?>">
                                        <?php echo e(@$o->order_id); ?></a>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->qty); ?></p>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->size->name_ar); ?></p>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->price); ?></p>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->discount_ratio ?? '0'); ?></p>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->discount ?? '0'); ?> </p>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->total); ?></p>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->order->paymentType->name_ar); ?></p>
                                    <p> <?php echo e(@$o->order->paymentType->name_en); ?></p>
                                </td>
                                <td class="text-center">
                                    <p> <?php echo e(@$o->order->paymentType->ratio); ?> %</p>
                                </td>

                                <td class="text-center">
                                    <?php if(@$o->order->paymentType->ratio > 0): ?>
                                        <p><?php echo e((@$o->order->paymentType->ratio * @$o->total) / 100); ?></p>
                                    <?php else: ?>
                                        <p>0</p>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <p> <?php echo e(@$o->total - (@$o->order->paymentType->ratio * @$o->total) / 100); ?></p>
                                </td>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php

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
            ?>
            <div>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>المصمم</th>
                            <td>
                                <?php echo e($store->name_ar); ?> - <?php echo e($store->name_en); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>التاريخ</th>
                            <td>
                                <?php echo e($date_from); ?> -- <?php echo e($date_to); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>الإجمالي</th>
                            <td>
                                <?php echo e($sum); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>مصاريف إدارية</th>
                            <td><?php echo e($tcom); ?></td>
                        </tr>
                        <tr>
                            <th>عمولات سداد</th>
                            <td><?php echo e($tax); ?></td>
                        </tr>
                        <tr class="table-active">
                            <th>الصافي المستحق</th>
                            <td><?php echo e($total); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="note note-info">
                <h4 class="block">لا يوجد بيانات مضافة</h4>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>
<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/export_sales.blade.php ENDPATH**/ ?>