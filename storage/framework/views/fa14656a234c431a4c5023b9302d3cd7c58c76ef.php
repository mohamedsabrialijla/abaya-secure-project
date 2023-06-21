<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'), 'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.products.index'),'title'=>'المنتجات'],
        ['page'=>'','title'=>$title]
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'), 'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.products.index'),'title'=>'المنتجات'],
        ['page'=>'','title'=>$title]
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
    <style>
        .bg-red{
            background-color: #BD362F;
            color: whitesmoke !important;
        }
        .bg-red:hover{
            color:black !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>




    <?php $__env->startComponent('components.ShowCard',[
   'Disname'=>'المقاسات',
   'Disinfo'=>@$title,
   'actions'=>[

   ]
   ]); ?>



<ul class="nav nav-tabs nav-bold nav-tabs-line">

    <?php $__currentLoopData = $product->productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item ">
        <a class="nav-link <?php echo e((isset($active_tab) && $active_tab=="tab".$key+1)?'active':$key==0?'active':''); ?>"
           data-toggle="tab" href="#tab<?php echo e($key+1); ?>">
            <?php echo e($size->size->name); ?>

        </a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</ul>


<div class="tab-content">
    <?php $__empty_1 = true; $__currentLoopData = $product->productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$productSize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="tab-pane <?php echo e((isset($active_tab) && $active_tab=="tab".$key+1)?'active':$key==0?'active':''); ?> " id="tab<?php echo e($key+1); ?>" role="tabpanel">
    <div class="row">
        <br/>
        <div class="col-md-8 mt-5">
            <div class="d-flex justify-content-end">
                <button
                    class="<?php echo e(config('layout.classes.warning')); ?>  mt-2 showWithdrawFormModal"
                    title="سحب كمية"
                    data-tab="tab<?php echo e($key+1); ?>"
                    data-id="<?php echo e($productSize->id); ?>"
                    data-toggle="tooltip"
                    data-theme="dark"
                    data-placement="top">
                    سحب كمية
                </button>
                <button
                    class="<?php echo e(config('layout.classes.warning')); ?>  mt-2 showFormModal ml-5"
                    title="اضافة كمية جديدة"
                    data-tab="tab<?php echo e($key+1); ?>"
                    data-id="<?php echo e($productSize->id); ?>"
                    data-toggle="tooltip"
                    data-theme="dark"
                    data-placement="top">
                        إضافة كمية
                </button>



            </div>
        </div>

    </div>

<div class="row mt-5">


    <div class="col-md-8">


        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>المقاس</th>
                    <th>العملية</th>
                    <th>الطلب</th>
                    <th>سبب السحب </th>
                    <th>تاريخ العملية</th>
                    <th>الكمية</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
            <tr class="table-active">
                <td colspan="6">
                    اجمالي الكمية المتوفرة
                </td>
                <td  class="available-qty-<?php echo e($key); ?>">
                    <?php echo e($productSize->qty()); ?>

                </td>
                <td></td>
            </tr>
            <?php $__currentLoopData = $productSize->stock()->orderBy('created_at','desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="<?php echo e($stock->type=='withdraw'?"bg-red":''); ?>">
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($stock->productSize->size->name); ?></td>
                        <td><?php echo e($stock->type_label); ?></td>
                        <td>
                            <?php if($stock->order): ?>
                            <a href="<?php echo e(route('system.orders.details',$stock->order->id)); ?>"
                               style="line-height: 25px;font-weight: bold">
                                <span><?php echo e($stock->order->invoice_number); ?></span>
                                <span>#</span>
                            </a>
                            <?php else: ?>
                                --
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($stock->reason); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($stock->created_at)->format('Y-m-d H:i:s')); ?></td>
                        <td><?php echo e($stock->qty); ?></td>
                    <td class="text-center">

                        <ul class="list-inline">

                            <?php if($stock->type=='deposit'): ?>

                                <li>

                                    <button type="button"
                                            data-id="<?php echo e($stock->id); ?>"
                                            data-key="<?php echo e($key); ?>"
                                            data-url="<?php echo e(route('system.stock.delete')); ?>"
                                            data-token="<?php echo e(csrf_token()); ?>"
                                            data-toggle="tooltip" data-theme="dark" title="حذف"
                                            class="<?php echo e(config('layout.classes.delete')); ?>  mt-2 btn-del-size">
                                        <i class="<?php echo e(config('layout.icons.delete_icon')); ?>"></i>
                                        حذف
                                    </button>













                                </li>
                                <?php endif; ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>
    </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="row">
            <div class="col-md-12 justify-content-center text-center">
                <h4 class="mt-5">

                    لا يوجد مقاسات  للمنتج بامكانك اضافة مقاسات جديدة من صفحة تعديل المنتج
                </h4>
            </div>
        </div>
    <?php endif; ?>
</div>

    <?php echo $__env->renderComponent(); ?>

    <div class="modal" id="addNewQtyModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">اضافة كمية</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">

                            <?php $__env->startComponent('components.input',['name'=>'qty' ,'text'=>'الكمية','not_req'=>true]); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="qty_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button" class="btn  btn-primary  add_new_qty ">
                            اضافة

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="modal" id="withdrawNewQtyModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">سحب كمية</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">

                            <?php $__env->startComponent('components.input',['name'=>'withdraw_qty' ,'text'=>'الكمية']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="withdraw_qty_error"></span>

                        </div>
                        <div class="col-md-12">

                            <?php $__env->startComponent('components.input',['name'=>'reason' ,'text'=>'السبب']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="reason_error"></span>

                        </div>
                        <div class="w-100"></div>

                        <button type="button" class="btn  btn-primary  withdraw_new_qty ">
                            سحب

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="modal" id="updateQtyModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">تحديث كمية</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">

                            <?php $__env->startComponent('components.input',['name'=>'new_qty' ,'text'=>'الكمية','id'=>'update_qty']); ?>
                            <?php echo $__env->renderComponent(); ?>
                            <span class="text-danger" id="new_qty_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button" class="btn  btn-primary  update_new_qty ">
                            تحديث

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>

    <script>
        var product_size_id,activeTab,stock_id,prev_qty;
        $('.showFormModal').click(function () {

             product_size_id= $(this).data('id');
             activeTab=$(this).data('tab');

            submit(product_size_id,activeTab);

        });


        function submit(product_size_id,activeTab) {

            $("#addNewQtyModal").modal('show');

            $('.add_new_qty').click(function (e) {
                e.preventDefault();
                var qty =$('input[name=qty]').val();
                var token = '<?php echo e(csrf_token()); ?>';

                var url = '<?php echo e(route('system.products.add.qty')); ?>';

                $.post(url, {
                        _token: token,
                        product_size_id: product_size_id,
                        qty: qty,
                        activeTab: activeTab

                    },

                    function (data, status) {
                        if (data) {
                            $("#addNewQtyModal").modal('hide');
                            location.reload();
                        } else {
                            alert('هناك خطأ ما');
                        }
                    })
                    .fail(function (data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function (key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        });//end each
                    });

            });
        }  $('.showWithdrawFormModal').click(function () {

             product_size_id= $(this).data('id');
             activeTab=$(this).data('tab');

            withdraw(product_size_id,activeTab);

        });

        function withdraw(product_size_id,activeTab) {

            $("#withdrawNewQtyModal").modal('show');

            $('.withdraw_new_qty').click(function (e) {
                e.preventDefault();

                var qty =$('input[name=withdraw_qty]').val();
                var reason =$('input[name=reason]').val();
                var token = '<?php echo e(csrf_token()); ?>';

                var url = '<?php echo e(route('system.products.withdraw.qty')); ?>';

                $.post(url, {
                        _token: token,
                        product_size_id: product_size_id,
                        withdraw_qty: qty,
                        reason: reason,
                        activeTab: activeTab

                    },

                    function (data, status) {
                        if (data) {
                            $("#withdrawNewQtyModal").modal('hide');
                            location.reload();
                        } else {
                            alert('هناك خطأ ما');
                        }
                    })
                    .fail(function (data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function (key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        });//end each
                    });

            });
        }
        $('.updateQty').click(function () {

            product_size_id= $(this).data('id');
            stock_id= $(this).data('stock');
            prev_qty= $(this).data('qty');
            activeTab=$(this).data('tab');

            updateQty(product_size_id,stock_id,prev_qty);

        });
        function updateQty(product_size_id,stockId, qty) {
            console.log(qty);
            $('input[name=new_qty]').val(qty);
            $("#updateQtyModal").modal('show');



            $('.update_new_qty').click(function (e) {
                e.preventDefault();

                var qty = $('input[name=new_qty]').val();
                var token = '<?php echo e(csrf_token()); ?>';
                var url = '<?php echo e(route('system.product.size.qty.update')); ?>';
                $.post(url, {
                        _token: token,
                        product_size_id: product_size_id,
                        new_qty : qty ,
                        stock_id : stockId
                    },
                    function (data, status) {
                        if (data) {
                            $("#updateQtyModal").modal('hide');
                            location.reload();
                        } else {
                            alert('هناك خطأ ما');
                        }
                    })
                    .fail(function (data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function (key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        });//end each
                    });

            });

        }


        $("body").on('click', '.btn-del-size',

            function () {

                var desc = $(this).data('desc') ? $(this).data('desc') : '';

                var Id = $(this).data('id');

                var url = $(this).data('url');

                var token = $(this).data('token');
                var key = $(this).data('key');

                var thisF = $(this);

                Swal.fire(
                    {

                        title: "هل انت متأكد ؟",

                        text: "هل تريد بالتأكيد حذف العنصر" + '   ' + desc,

                        icon: "warning",

                        showCancelButton: 1,

                        confirmButtonText: "نعم , قم بالحذف !",

                        cancelButtonText: "لا, الغي العملية !",

                        reverseButtons: 1

                    }).then(function (e) {


                    if (e.value) {


                        $.post(url,

                            {

                                _token: token,

                                id: Id,

                            },

                            function (data, status) {

                                if (data.done == 1) {
                                        console.log(data);
                                    $('.available-qty-'+key).html(data.qty);
                                    Swal.fire({

                                        title: 'تم الحذف بنجاح',

                                        text: data.msg,

                                        icon: 'success',

                                        timer: 2000,

                                        showConfirmButton: false

                                    }).then(
                                        function () {

                                            var ra = thisF.parents('tr');

                                            var d = thisF.parents('.productItem');

                                            var table = thisF.parents('table');


                                            d.css('background', '#f00').fadeOut(600);

                                            ra.css('background', '#f00').fadeOut(600, function () {

                                                ra.remove();

                                                var num = 1;

                                                table.find('.LOOPIDS').each(function () {

                                                    $(this).text(num);

                                                    num = num + 1;

                                                });

                                            });


                                        }
                                    )

                                } else {


                                    Swal.fire({

                                        title: 'حدث خطأ ',

                                        text: data.msg,

                                        icon: 'error',

                                        timer: 4000,

                                        showConfirmButton: false

                                    })


                                }

                            }).fail(function (data2, status) {

                            var data2 = data2.responseJSON;

                            Swal.fire({

                                title: 'خطأ',

                                text: data2.response_message,

                                icon: 'error',

                                timer: 4000,

                                showConfirmButton: false

                            })

                        });


                    } else {

                        e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");


                    }

                });


            });


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/products/sizes.blade.php ENDPATH**/ ?>