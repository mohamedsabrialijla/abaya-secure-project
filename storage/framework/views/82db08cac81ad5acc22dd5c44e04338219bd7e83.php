






        <tbody wire:sortable="updateTaskOrder">

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="TR_<?php echo e($o->id); ?>" wire:sortable.item="<?php echo e($o->id); ?>" wire:key="task-<?php echo e($o->id); ?>" >

            <td class="LOOPIDS"><?php echo e($loop->iteration); ?></td>
            <td style="text-align: center;vertical-align: middle;">
                <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                    <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                           id="che_<?php echo e($o->id); ?>">
                    <span></span>
                </label>
            </td>
            <td class="text-right" >
                <img src="<?php echo e($o->image_url); ?>" class="img_table" alt="">
                <?php echo e($o->name); ?>

            </td>
            <td class="text-center" >
               <span > <?php echo e(@$o->category->name); ?></span>
            </td>
            <td class="text-center"> <?php echo e(@$o->store->name); ?></td>
            <td class="text-center"> <?php if($o->has_discount): ?> <span
                    class="old_price"><?php echo e($o->real_price); ?></span>  <span
                    class="new_price"><?php echo e($o->price); ?> <?php echo e(\App\Models\Settings::get('currency_ar')); ?></span><?php else: ?> <?php echo e($o->price); ?>  <?php echo e(\App\Models\Settings::get('currency_ar')); ?><?php endif; ?>
            </td>

            <td class="text-center">
                <?php if($o->is_active == 1): ?>
                    <span class="font-success"> مفعل </span>

                <?php elseif($o->is_active == 0): ?>
                    <span class="font-warning"> معطل </span>
                <?php else: ?>
                    <span class="m--font-warning"> مجهول </span>
                <?php endif; ?>
            </td>
            <td class="text-center"> <?php echo e(@$o->created_at->toDateString()); ?></td>
            <td class="text-center">

                <ul class="list-inline">

                    <?php if(auth('system_admin')->user()->can('edit_products','system_admin')||auth('system_admin')->user()->can('feature_products','system_admin')): ?>

                        <li>

                            <button type="button"
                                    class="<?php echo e(config('layout.classes.warning')); ?>  mt-2 update"
                                    title="تعديل "
                                    data-ar="<?=$o->annotation_ar?>"
                                    data-en="<?=$o->annotation_en?>"
                                    data-feature="<?php echo e($o->feature_image_url); ?>"
                                    data-id="<?= $o->id ?>"
                                    data-url="<?php echo e(route('system.featureProducts.update')); ?>"
                                    data-token="<?php echo e(csrf_token()); ?>"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    data-placement="top"
                            >
                                <i class="fa fa-edit"></i> تعديل
                            </button>
                        </li>
                        <li>
                            <button type="button"
                                    data-id="<?= $o->id ?>"
                                    data-url="<?php echo e(route('system.featureProducts.change_show_feature_product')); ?>"
                                    data-token="<?php echo e(csrf_token()); ?>"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    data-placement="top"
                                    title="<?php echo e($o->is_feature == 1?'اخفاء المنتج من المنتجات المميزة':'عرض المنتج في المنتجات المميزة'); ?>"
                                    class="<?php echo e(config('layout.classes.warning')); ?> mt-2 btn-doAction">
                                <i class="fa fa-eye "></i>
                                <?php echo e($o->is_feature == 0?'عرض':'اخفاء'); ?>

                            </button>
                        </li>
                        <li>
                            <button  type="button" class="<?php echo e(config('layout.classes.warning')); ?> btn-icon" wire:sortable.handle>
                                <i class="la la-arrows-v"></i>
                            </button>
                        </li>
                    <?php endif; ?>
                </ul>

            </td>
        </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>

<?php /**PATH /home/abayasquare/public_html/resources/views/livewire/feature-products.blade.php ENDPATH**/ ?>