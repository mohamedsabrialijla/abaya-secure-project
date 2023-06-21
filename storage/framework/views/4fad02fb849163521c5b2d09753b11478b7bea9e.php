<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Abaya Square Invoice</title>
    <style>
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            src: url('public/fonts/Cairo/Cairo-Regular.ttf');
        }
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Cairo;
        }

        body {
            font-family: 'Cairo', sans-serif;
            text-align: right;
            direction: rtl;
        }

        p {
            margin-bottom: 0;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        div[size="A4"] {
            width: 14.8cm;
            height: auto;
            margin: 0 auto;

        }

        .bill-wrapper {
            position: relative;
            min-height: 21cm;
            border-top: 6px solid #BFBFBF;

        }


        .bill-wrapper-container {
            width: 95%;
            margin: 0 auto;
        }


        .bill-header {
            padding: 5px 0;
            border-bottom: 1px solid #BFBFBF;
        }

        .bill-header .bill-header-number {
            float: left;
            text-align: left;
        }

        .bill-header .bill-header-number h5 {
            font-size: 28px;
            font-weight: bold;
        }

        .bill-header .bill-header-info {
            float: right;
            width: 50%;
        }

        .bill-header .bill-header-info div {
            /* line-height: 1.8; */
        }

        .bill-header .bill-header-info p {
            font-size: 15px;
            font-weight: 500;
        }

        .customer-info {

            padding: 10px 0;
            border-bottom: 1px solid #BFBFBF;
            width: 100%;

        }

        .customer-info .customer-info-col {
            /* line-height: 18px; */
            width: 50%;
            float: right;
        }

        .customer-info .customer-info-col h4 {
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .customer-info .customer-info-col div label {
            font-weight: bold;
            font-size: 10px;
        }

        .customer-info .customer-info-col div span {
            padding-right: 5px;
            font-size: 13px;
            font-weight: 600;
        }


        /* Thead */


        /* bill info */
        .table td,
        .table th {
            border: none;
        }

        .bill-wrapper .table-content th {
            font-size: 13px;
        }

        .bill-wrapper .table-content td {
            font-size: 13px;
        }


        .bill-wrapper .bill-table table td,
        .bill-wrapper .bill-table table th {
            border: none;
            padding: 5px 15px;
            text-align: center;
        }

        .bill-wrapper .bill-table {
            padding: 20px 0;
            border-bottom: 1px solid #BFBFBF;
        }

        .bill-wrapper .bill-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .bill-wrapper .bill-table table thead th {
            vertical-align: middle;
            background: #191919;
            font-weight: bold;
            color: #FFF;
            font-size: 13px;
        }

        .bill-wrapper .bill-table table thead th.product-name,
        .bill-wrapper .bill-table table tbody td.product-name {
            text-align: right;
        }

        .bill-wrapper .bill-table table tbody tr {
            border-bottom: 1px solid #E9E9E9;
        }

        .bill-wrapper .bill-table table tbody tr td {
            font-weight: 600;
            font-size: 13px;
        }

        .bill-wrapper .bill-table table tbody tr.totla,
        .bill-wrapper .bill-table table tbody tr.discount,
        .bill-wrapper .bill-table table tbody tr.vat,
        .bill-wrapper .bill-table table tbody tr.deserved-amount {
            font-weight: 500;
            border-bottom: none !important;
        }

        .bill-wrapper .bill-table table tbody tr.deserved-amount td {
            background: #E9E9E9;
            font-weight: bold;
        }

        .bill-wrapper .bill-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px 0;
            border-bottom: 2px solid #BFBFBF;
            border-top: 1px solid #BFBFBF;
            position: absolute;
            bottom: 0;
            width: 100%;
            right: 0;

        }

        .bill-wrapper .bill-footer p {
            color: #000000;
            font-size: 14px;
            text-align: center;
        }

    </style>
    
    
    
    
    
</head>

<body dir="rtl">

<div size="A5" id="page-wrap">
    <div class="bill-wrapper">

        <div class="bill-wrapper-container">

            <div class="customer-info">


                <div class="customer-info-col">

                    <div>
                        <img src="<?php echo e(asset('logos/logo_abaya.png')); ?>" alt="" width="40" height="40">
                    </div>
                    <div>
                        <label>المتجر :</label>
                        <span> <?php echo e(@$app_name); ?></span>
                    </div>
                    <div>
                        <label>رقم الفاتورة :</label>
                        <span dir="ltr">#<?php echo e(@$order->invoice_number); ?></span>
                    </div>
                    <div>
                        <label> التاريخ:</label>
                        <span><?php echo e(date('Y-m-d')); ?> </span>
                    </div>
                    <div>
                        <label>الموبايل :</label>
                        <span><?php echo e(@$app_mobile); ?> </span>
                    </div>
                    <div>
                        <label>البريد الالكتروني :</label>
                        <span><?php echo e(@$app_email); ?> </span>
                    </div>
                </div>


                <div class="customer-info-col">
                    <h4>بيانات الزبون</h4>
                    <div>
                        <label>اسم الزبون :</label>
                        <span> <?php echo e(@$order->customer->name??@$order->address->name); ?></span>
                    </div>
                    <div>
                        <label>الموبايل :</label>
                        <span dir="ltr">+<?php echo e(@$order->address->mobile); ?></span>
                    </div>
                    <div>
                        <label>البريد الالكتروني:</label>
                        <span><?php echo e(@$order->customer->email); ?> </span>
                    </div>
                    <div>
                        <label>العنوان :</label>
                        <span><?php echo e(@$order->address->address); ?> </span>
                    </div>
                </div>

            </div>

            <div class="bill-table">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="product-name">
                            المنتج
                        </th>
                        <th>المصمم</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>كوبون خصم</th>
                        <th>الخصم</th>
                        <th>المجموع</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total_cost =0 ?>
                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $total_cost+=$product->total; ?>
                        <tr>
                            <td>1</td>
                            <td class="product-name"> <?php echo e(@$product->product->name); ?> </td>
                            <td> <?php echo e(@$product->designer->name); ?>  </td>
                            <td> <?php echo e(@$product->price); ?>  </td>
                            <td> <?php echo e(@$product->qty); ?> </td>
                            <td> <?php echo e(isset($product->coupon->code)?@$product->coupon->code:'-'); ?>  </td>
                            <td> <?php echo e($product->discount_ratio?@$product->discount_ratio.('%'):'-'); ?> </td>
                            <td>
                                <?php echo e($product->total_before_discount); ?>

                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tr class="totla">
                        <td colspan="6"></td>
                        <td>المجموع</td>
                        <td>
                            <?php echo e($order->sub_total_1); ?>

                        </td>
                    </tr>


                    <tr class="vat">
                        <td colspan="6"></td>
                        <td> الضريبة  <span>(<?php echo e(@$order->tax_ratio); ?>%)</span></td>
                        <td>
                            <?php echo e(($order->tax)); ?>

                        </td>
                    </tr>

                    <tr>
                        <td colspan="6"></td>
                        <td>تكلفة التوصيل</td>
                        <td>
                            <?php echo e($order->delivery_cost); ?>

                        </td>


                    </tr>
                    <tr class="discount">
                        <td colspan="6"></td>
                        <td>الخصم (
                            <?php if($order->promo_code): ?>
                                كود ترويجي
                            <?php else: ?>
                                كوبون مصمم
                            <?php endif; ?>
                            <?php echo e(")"); ?></td>
                        <td>
                            <?php echo e(($order->discount)); ?>


                        </td>
                    </tr>


                    <tr class="deserved-amount">
                        <td colspan="6"></td>
                        <td>المجموع النهائي</td>
                        <td>  <?php echo e(($order->total)); ?>

                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>

            <div class="bill-footer">
                <p>شكرا لتعاملك معنا</p>
            </div>
        </div>
    </div>


</div>


</body>

</html>
<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/orders/print.blade.php ENDPATH**/ ?>