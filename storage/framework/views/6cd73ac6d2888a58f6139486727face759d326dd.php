
<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
    <style>
        .path-item {
            background: #eee;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: center;
            padding: 10px 20px;
        }

        .list-order .list-order-row {
            width: 60%;
            padding: 10px 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .list-order-total {
            width: 100%;
            padding: 10px 0;
            border-top: 3px solid #f2f2f2;
        }

        .list-order-total div {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            width: 60%;
            font-weight: 700;
        }

        .list-order .list-order-row span {
            font-weight: 700;
            display: inline-block;
            color: #4d565c;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
        }

        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            right: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
            padding-right: 20px;
        }

        ul.timeline>li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            right: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }

    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_content'); ?>
    <div class="row">
        <div class="col-xl-6 col-12">

            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            بيانات الطلب
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">

                            <a href="<?php echo e($order->invoice_url); ?>" target="_blank" class="btn btn-black btn-sm">
                                <i class="la la-print la-3x "></i>
                            </a>



                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="m-content">
                        <div class="order-data">

                            <div class="form-group row mb-3">
                                <label class="col-sm-3">رقم الطلب</label>
                                <div class="col-sm-9">
                                    <p>#<?php echo e($order->invoice_number); ?></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3">تاريخ الطلب</label>
                                <div class="col-sm-9">

                                    <span class="calendar">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>

                                        <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')); ?>


                                        <i class="fa fa-clock" aria-hidden="true"></i>

                                        <?php echo e(\Carbon\Carbon::parse($order->created_at)->format('H:i A')); ?>


                                    </span>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3">طريقة الدفع</label>
                                <div class="col-sm-9">
                                    <span>
                                        <?php echo e(@$order->paymentType->name); ?>

                                    </span>
                                    &nbsp; &nbsp;
                                    <?php if($order->payment_type_id != 4 && $order->use_wallet): ?>
                                        استخدم رصيد محفظة (<?php echo e($order->wallet_amount); ?>)
                                    <?php endif; ?>

                                </div>
                            </div>


                            <?php if($order->transaction && $order->transaction->tranid): ?>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3"> الرقم المرجعي : </label>
                                    <div class="col-sm-9">
                                        <span>
                                            <?php echo e(@$order->transaction->tranid); ?>

                                        </span>
                                        &nbsp;
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($order->payment_type_id == '10'): ?>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3"> الرقم المرجعي : </label>
                                    <div class="col-sm-9">
                                        <span>
                                            <?php echo e(@$order->tamara); ?>

                                        </span>
                                        &nbsp;
                                    </div>
                                </div>
                            <?php endif; ?>


                            <!--<?php if($order->payment_type_id == '3' || $order->payment_type_id == '2'): ?>-->
                            <!--    <div class="form-group row mb-3">-->
                            <!--        <label class="col-sm-3">3 الرقم المرجعي : </label>-->
                            <!--        <div class="col-sm-9">-->
                            <!--            <span>-->
                            <!--                <?php echo e(@$order->reference_number); ?>-->
                            <!--            </span>-->
                            <!--            &nbsp;-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--<?php endif; ?>-->




                            <div class="form-group row mb-3">
                                <label class="col-sm-3">حالة الطلب</label>
                                <div class="col-sm-9">
                                    <div class="order-status-btn">
                                        <?php echo e(@$order->status->name); ?>

                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($order->shipment_id): ?>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">رقم الشحنة</label>
                                    <div class="col-sm-9">
                                        <div class="order-status-btn">
                                            <?php echo e(@$order->shipment_id); ?>

                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 "> العمليات</label>
                                <div class="col-sm-9">
                                    <div class="order-status-btn">
                                        <?php if(auth('system_admin')->user()->can('edit_orders', 'system_admin')): ?>
                                            <?php if($order->case_id == 1): ?>
                                                <button class="<?php echo e(config('layout.classes.add')); ?> btn-action">
                                                    تأكيد
                                                </button>
                                            <?php elseif($order->case_id == 3): ?>
                                                <button class="<?php echo e(config('layout.classes.add')); ?> btn-action">
                                                    جاري الشحن
                                                </button>
                                            <?php elseif($order->case_id == 4): ?>
                                                <button class="<?php echo e(config('layout.classes.add')); ?> btn-action">
                                                    تم الشحن
                                                </button>
                                            <?php elseif($order->case_id == 5): ?>
                                                <button class="<?php echo e(config('layout.classes.add')); ?> btn-action">
                                                    جاري التوصيل
                                                </button>
                                            <?php elseif($order->case_id == 6): ?>
                                                <button class="<?php echo e(config('layout.classes.add')); ?> btn-action">
                                                    تم التوصيل
                                                </button>
                                            <?php elseif($order->case_id == 7): ?>
                                                <button class="<?php echo e(config('layout.classes.add')); ?> btn-action">
                                                    مسترجع
                                                </button>
                                            <?php elseif($order->case_id == 2): ?>
                                                <span>ملغي</span>
                                            <?php elseif($order->case_id == 8): ?>
                                                <span>مرجع</span>
                                            <?php endif; ?>

                                            <?php if($order->case_id != 8 && $order->case_id != 7 && $order->case_id != 2): ?>
                                                <button class="<?php echo e(config('layout.classes.delete')); ?> btn-action-6"> ملغي
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-6 col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            بيانات الزبون
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">

                            <a href="<?php echo e(route('system.orders.index', ['status' => Str::lower($order->status->name_en)])); ?>"
                                class="<?php echo e(config('layout.classes.black')); ?> m-2">
                                <i class="la la-arrow-right"></i>
                                رجوع
                            </a>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="m-content">
                        <div class="order-data">
                            <form>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">اسم الزبون</label>
                                    <div class="col-sm-9">
                                        <p> <?php echo e(@$order->customer->name); ?></p>
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">جوال الزبون</label>
                                    <div class="col-sm-9">
                                        <p dir="ltr"> <?php echo e(@$order->customer->mobile); ?> </p>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">ايميل الزبون</label>
                                    <div class="col-sm-9">
                                        <p dir="ltr"> <?php echo e(@$order->customer->email); ?> </p>
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label class="col-sm-3">عنوان تسليم الطلب</label>
                                    <div class="col-sm-9" dir="rtl">
                                        <p> الاسم :<?php echo e(@$order->address->name); ?> </p>
                                        <p> العنوان :<?php echo e(@$order->address->address); ?> </p>
                                        <p> الجوال :<?php echo e(@$order->mobile); ?> </p>
                                        <p> المدينة :<?php echo e(@$order->address->area->name); ?> </p>
                                        <p> العنوان على الخريطة :<span class="fa fa-globe show-map pointer-event"></span>
                                        </p>
                                        

                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <br />
    <div class="row">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            منتجات الطلب
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="card-toolbar">


                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>صورة المنتج</th>
                                    <th>اسم المصمم</th>
                                    <th>اسم المنتج</th>
                                    <th>المقاس</th>
                                    <th>الكمية</th>
                                    <th>السعر(<?php echo e(@$currency); ?>)</th>
                                    <th>الخصم(<?php echo e(@$currency); ?>)</th>
                                    <th>المجموع(<?php echo e(@$currency); ?>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><img src="<?php echo e(asset('uploads/' . @$product->product->image)); ?>" width="70"
                                                height="70" /></td>
                                        <td><?php echo e(@$product->product->store->name); ?></td>
                                        <td><?php echo e(@$product->product->name); ?></td>
                                        <td><?php echo e(@$product->size->name); ?></td>
                                        <td><?php echo e(@$product->qty); ?></td>
                                        <td><?php echo e(@$product->price); ?></td>
                                        <td><?php echo e(@$product->discount); ?></td>
                                        <td><?php echo e(@$product->total); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            الملخص الاجمالي
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>


                </div>

                <div class="card-body">


                    <div class="list-order">
                        <div class="list-order-row">
                            <label>
                                اجمالي سعر المنتجات :
                            </label>
                            <span>
                                <?php echo e($order->sub_total_1); ?> <span><?php echo e($currency); ?></span>
                            </span>
                        </div>
                        <div class="list-order-row">
                            <label>
                                ض.ق.م
                            </label>
                            <span>
                                <?php echo e(@$order->tax); ?> <span><?php echo e($currency); ?></span>
                            </span>
                        </div>
                        <div class="list-order-row">
                            <label>
                                قيمة الخصم
                                <?php if($order->discount && $order->promo_code): ?>
                                    ( كود ترويجي )
                                <?php elseif($order->discount): ?>
                                    (كوبون مصمم)
                                <?php endif; ?>

                            </label>
                            <span>
                                <?php echo e(@$order->discount); ?> <span><?php echo e($currency); ?></span>
                            </span>
                        </div>
                        <div class="list-order-row">
                            <label>
                                رسوم التوصيل :
                            </label>
                            <span>
                                <?php echo e($order->delivery_cost); ?> <span><?php echo e($currency); ?></span>
                            </span>
                        </div>

                        <?php if($order->replaced == 1): ?>
                        <div class="list-order-row">
                            <label>
                                رسوم الاستبدال :
                            </label>
                            <span>
                                <?php echo e($order->replacement_fee); ?> <span><?php echo e($currency); ?></span>
                            </span>
                        </div>
                        <?php endif; ?>

                    </div>

                    <div class="list-order-total">
                        <div>
                            <label>
                                الإجمالي الكلي
                            </label>
                            <span>
                                <?php echo e($order->total); ?> <span><?php echo e($currency); ?></span>
                            </span>
                        </div>
                    </div>

                    <div class="list-order">

                        <?php if($order->use_wallet): ?>
                            <div class="list-order-row">
                                <label>
                                    رصيد المحفظة المستخدم :
                                </label>
                                <span>
                                    <?php echo e($order->wallet_amount); ?> <span><?php echo e($currency); ?></span>
                                </span>
                            </div>
                        <?php endif; ?>


                        <?php if($order->payment_type_id == 1): ?>
                            <div class="list-order-row">
                                <label>
                                    المبلغ للدفع :
                                </label>
                                <span>
                                    <?php echo e($order->cod_amount ?? 0); ?> <span><?php echo e($currency); ?></span>
                                </span>
                            </div>
                        <?php endif; ?>




                        <?php if($order->transaction): ?>
                            <div class="list-order-row">
                                <label>
                                    رصيد المدفوع :
                                </label>
                                <span>
                                    <?php echo e($order->transaction->amount); ?> <span><?php echo e($currency); ?></span>
                                </span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            سجل الطلب
                            <div class="text-muted pt-2 font-size-sm"></div>
                        </h3>
                    </div>


                </div>

                <div class="card-body">


                    <ul class="timeline">

                        <?php $__currentLoopData = $activityLog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:;"><?php echo e(@$log->case->name); ?></a>
                                <a href="javascript:;" class="float-right">
                                    <?php echo e(\Carbon\Carbon::parse(@$log->created_at)->translatedFormat('D jS M Y g:i a')); ?>

                                </a>
                                <p><?php echo e(@$log->case->details); ?></p>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>


                </div>

            </div>
        </div>
    </div>



    <div class="modal" id="map-modal" data-backdrop="static">
        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title">الموقع</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">

                        <div class="col-md-12" id="map" style="width:400px;  height: 400px;"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('custom_scripts'); ?>
    <script>
    //adfafsaf
        $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
        $(function() {
            $('.btn-action').click(function(e) {
                e.preventDefault();

                swal.fire({
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد تغيير حالة الطلب الطلب",
                    type: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتغيير !",
                    cancelButtonText: "لا, الغي العملية !",
                    reverseButtons: 1
                }).then(function(e) {

                    if (e.value) {
                        var token = '<?= csrf_token() ?>';
                        var url = '<?php echo e(route('system.orders.change_status')); ?>';
                        var order = <?= $order->id ?>;
                        $.post(url, {
                                _token: token,
                                id: order
                            },
                            function(data, status) {
                                if (data.done == true) {
                                    if (data.title) {
                                        swal.fire(data.title, data.message, "info").then(() => {
                                            location.reload();
                                        })
                                    }
                                    swal.fire("تم تنفيذ العملية", "تم تغيير الحالة بنجاح",
                                        "success").then(() => {
                                        location.reload();
                                    })

                                } else {
                                    if (data.message) {
                                        swal.fire("خطأ", data.message, "error");
                                    } else {
                                        swal.fire("هناك خطأ ما", '', "error");

                                    }

                                }
                            });

                    } else {
                        e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");

                    }
                });


            });
            $('.btn-action-6').click(function() {

                swal.fire({
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد الغاء الطلب",
                    type: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتغيير !",
                    cancelButtonText: "لا, الغي العملية !",
                    reverseButtons: 1
                }).then(function(e) {

                    if (e.value) {
                        var token = '<?= csrf_token() ?>';
                        var url = '<?php echo e(route('system.orders.change_order_status_to_can')); ?>';
                        var order = <?= $order->id ?>;
                        $.post(url, {
                                _token: token,
                                id: order,
                            },
                            function(data, status) {
                                if (data.done == true) {
                                    swal.fire("تم تنفيذ العملية", "تم تغيير الحالة بنجاح",
                                        "success").then(() => {
                                        location.reload();
                                    })
                                } else {
                                    alert('هناك خطأ ما');
                                }
                            });

                    } else {
                        e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");

                    }
                });


            });

        })
    </script>


    <script>
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: <?php echo e($order->address->lat); ?>,
                lng: <?php echo e($order->address->lng); ?>

            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpxsc_JdZZRhNV6hOs8BPmO63hXZNB3w4&callback=initMap&libraries=&v=weekly"
        async></script>

    <script>
        $('.show-map').click(function() {

            $("#map-modal").modal('show');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/new/resources/views/system_admin/orders/details.blade.php ENDPATH**/ ?>