<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.users.index'), 'title' => 'الزبائن'],
    ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.users.index'), 'title' => 'الزبائن'],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php
$Disname = 'تعديل المحفظة';
$Disinfo = $out->name;
?>
<?php $__env->startSection('title', $Disname); ?>
<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>
    <div class="card card-custom">
        <div class="card-header  card-header-tabs-line">
            <div class="card-title">
                <h3 class="card-label"><?php echo e($Disname); ?>

                    <div class="text-muted pt-2 font-size-sm"><?php echo e($Disinfo); ?></div>
                </h3>
            </div>
            <div class="card-toolbar">
                <span>
                    <a class="<?php echo e(config('layout.classes.delete')); ?>" href="<?php echo e(route('system.users.index')); ?>">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span>رجوع</span>
                    </a>
                </span>

            </div>

        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                        aria-controls="nav-home" aria-selected="true">البيانات الاساسية</a>

                    <a class="nav-item nav-link" id="nav-wallet-tab" data-toggle="tab" href="#nav-wallet" role="tab"
                        aria-controls="nav-wallet" aria-selected="true">تعديل المحفظة</a>

                    <a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab"
                        aria-controls="nav-address" aria-selected="false">عنواين الزبون</a>

                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false">طلبات الزبون</a>
                </div>
            </nav>
            <br>
            <br>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-10">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم</label>
                                        <input type="text" class="form-control" value="<?php echo e($out->name); ?>"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">البريد الالكتروني</label>
                                        <input type="text" class="form-control" value="<?php echo e($out->email); ?>"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الجوال</label>
                                        <input type="text" class="form-control" value="<?php echo e($out->mobile); ?>"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <?php
                                        $status = '';
                                        if ($out->status == 1) {
                                            $status = 'مفعل';
                                        } elseif ($out->status == 0) {
                                            $status = 'معطل';
                                        } elseif ($out->status == 2) {
                                            $status = 'محظور';
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">حالة الزبون</label>
                                        <input type="text" class="form-control" value="<?php echo e($status); ?>"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">النقاط</label>
                                        <input type="text" class="form-control" value="<?php echo e($out->points); ?>"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">المحفظة</label>
                                        <input type="text" class="form-control" value="<?php echo e($out->wallet); ?>"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                    </div>
                                </div>


                                <div class="w-100"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h5>صورة المستخدم</h5>
                            <div class="imageContainer">
                                <img src="<?php echo e($out->avatar_thumb_url); ?>" style="width: 100%;"
                                    class="MyImagePrivew thumbnail" alt="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="tab-pane fade " id="nav-wallet" role="tabpanel" aria-labelledby="nav-wallet-tab">
                    <div class="row">
                        <div class="col-10">
                            <form action="<?php echo e(route('user.wallet')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">النقاط</label>
                                            <input type="hidden" name="id" id="" value="<?php echo e($out->id); ?>">
                                            <input type="text" class="form-control" value="<?php echo e($out->points); ?>"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" name="points">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">المحفظة</label>
                                            <input type="text" class="form-control" value="<?php echo e($out->wallet); ?>"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" name="wallet">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button class="form-control btn btn-sm btn-success" type="submit">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">

                    <div class="col-lg-12">


                        <table class="table table-bordered" style="text-align: center;">


                            <?php if(isset($out->addresses) && count($out->addresses) > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>


                                                <th>#</th>
                                                <th class="text-center">الاسم</th>
                                                <th class="text-center"> الجوال</th>
                                                <th class="text-center">نص العنوان</th>
                                                <th class="text-center">الموقع</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $out->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr id="TR_<?php echo e($o->id); ?>">
                                                    <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>

                                                    <td class="text-center"> <?php echo e(@$o->name); ?></td>
                                                    <td class="text-center"> <?php echo e(@$o->mobile); ?></td>
                                                    <td class="text-center"> <?php echo e(@$o->address); ?></td>
                                                    <td><span class="fa fa-globe" data-lng="<?php echo e(@$o->lng); ?>"
                                                            data-lat="<?php echo e(@$o->lat); ?>"></span></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="note note-info">
                                                <h4 class="block">لا يوجد عنواين مسجلة لهذا المستخدم</h4>
                                            </div>
                            <?php endif; ?>
                        </table>


                    </div>

                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <div class="col-lg-12">

                        <?php if(isset($orders) && count($orders) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>


                                            <th>#</th>
                                            <th class="text-right">طلب رقم</th>
                                            <th class="text-center"> السعر الاجمالي</th>
                                            <th class="text-center">عدد المنتجات</th>
                                            <th class="text-center">طريقة الدفع</th>
                                            <th class="text-center">حالة الطلب</th>
                                            <th class="text-center">تاريخ الاضافة</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="TR_<?php echo e($o->id); ?>">

                                                <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>

                                                <td class="text-right">
                                                    <a href="<?php echo e(route('system.orders.details', $o->id)); ?>"
                                                        style="line-height: 25px;font-weight: bold">
                                                        <span><?php echo e($o->invoice_number); ?></span>
                                                        <span>#</span>
                                                    </a>
                                                </td>
                                                <td class="text-center"> <?php echo e($o->total); ?>

                                                    <?php echo e(\App\Models\Settings::get('currency_ar')); ?></td>
                                                <td class="text-center"> <?php echo e($o->products()->count()); ?></td>
                                                <td class="text-center"> <?php echo e($o->payment_type); ?></td>


                                                <td class="text-center">

                                                    <?php if($o->case_id == 1): ?>
                                                        <span class="m--font-success"> تم الاستلام </span>
                                                    <?php elseif($o->case_id == 2): ?>
                                                        <span class="m--font-warning"> ملغي </span>
                                                    <?php elseif($o->case_id == 3): ?>
                                                        <span class="m--font-warning"> جاري التوصيل </span>
                                                    <?php elseif($o->case_id == 4): ?>
                                                        <span class="m--font-warning"> تم الشحن </span>
                                                    <?php elseif($o->case_id == 5): ?>
                                                        <span class="m--font-warning"> تم التوصيل </span>
                                                    <?php elseif($o->case_id == 6): ?>
                                                        <span class="m--font-warning">طلب مرجع </span>
                                                    <?php endif; ?>

                                                </td>
                                                <td class="text-center"> <?php echo e(@$o->created_at->toDateString()); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="note note-info">
                                <h4 class="block">لا يوجد منتجات لهذا المستخدم</h4>
                            </div>
                        <?php endif; ?>

                    </div>

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
        $(function() {
            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',

            }).init();


        })
    </script>

    <script>
        function initMap() {
            $('.fa-globe').click(function() {
                // The location of Uluru
                let lat = $(this).data('lat');
                let lng = $(this).data('lng');
                const uluru = {
                    lat: lat,
                    lng: lng
                };
                // The map, centered at Uluru
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 4,
                    center: uluru,
                });
                // The marker, positioned at Uluru
                const marker = new google.maps.Marker({
                    position: uluru,
                    map: map,
                });
            });
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpxsc_JdZZRhNV6hOs8BPmO63hXZNB3w4&callback=initMap&libraries=&v=weekly"
        async></script>

    <script>
        $('.fa-globe').click(function() {

            $("#map-modal").modal('show');
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/customers/show.blade.php ENDPATH**/ ?>