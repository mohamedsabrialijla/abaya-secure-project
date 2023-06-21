<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => [
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخصائص العامة'],
        ]]]); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخصائص العامة'],
        ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_content'); ?>
    <?php $__env->startComponent('components.ShowCard',[
 'Disname'=>'الخصائص العامة',
 'Disinfo'=>'ادارة الخصائص العامة للموقع',
 'actions'=>[]
 ]); ?>
        <div class="row">
            <?php if(auth('system_admin')->user()->can('view_categories','system_admin')): ?>

                <?php $__env->startComponent('components.dash.card',[
                    'url'=>route('system.categories.index'),
                    'icon'=>'fa fa-list',
                    'name'=>'التصنيفات',
                    'count'=>$categories.' تصنيف',
                    'col'=>3

                ]); ?><?php echo $__env->renderComponent(); ?>
                
                <?php $__env->startComponent('components.dash.card',[
                    'url'=>route('system.categories_special.index'),
                    'icon'=>'fa fa-list',
                    'name'=>' التصنيفات الخاصة',
                    'count'=>$categories_s.' تصنيف',
                    'col'=>3

                ]); ?><?php echo $__env->renderComponent(); ?>

            <?php endif; ?>

            <?php if(auth('system_admin')->user()->can('view_colors','system_admin')): ?>
                <?php $__env->startComponent('components.dash.card',[
                  'url'=>route('system.colors.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'الألوان ',
                  'count'=>$colors.' لون',
                  'col'=>3

                ]); ?><?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            
            
            
          
            
            
              <?php if(auth('system_admin')->user()->can('view_style','system_admin')): ?>
                <?php $__env->startComponent('components.dash.card',[
                  'url'=>route('system.styles.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'الموديلات ',
                  'count'=>$styles.' موديل',
                  'col'=>3

                ]); ?><?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            
            
              <?php if(auth('system_admin')->user()->can('view_clothes','system_admin')): ?>
                <?php $__env->startComponent('components.dash.card',[
                  'url'=>route('system.clothes.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'الأقمشة',
                  'count'=>$clothes.' قماش',
                  'col'=>3

                ]); ?><?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
            
            

                <?php if(auth('system_admin')->user()->can('view_sizes','system_admin')): ?>
                <?php $__env->startComponent('components.dash.card',[
                  'url'=>route('system.sizes.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'المقاسات ',
                  'count'=>$sizes.' مقاس',
                  'col'=>3

                 ]); ?><?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
               <?php if(auth('system_admin')->user()->can('view_colors','system_admin')): ?>
                    <?php $__env->startComponent('components.dash.card',[
                      'url'=>route('system.govs.index'),
                      'icon'=>'fa fa-list',
                      'name'=>'المحافضات والمناطق ',
                      'count'=>$areas.'منطقة',
                      'col'=>3
                     ]); ?><?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
                
                
                
          
            
            
            
            
           
        </div>


    <?php echo $__env->renderComponent(); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_scripts'); ?>
    <script>
        $(function () {

        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/general_properties.blade.php ENDPATH**/ ?>