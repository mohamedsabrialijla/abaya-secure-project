<?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($message['overlay']): ?>
        <?php echo $__env->make('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <script>
            $('document').ready(function () {
                setTimeout(function() {
                    Swal.fire({
                        title: '<?php echo $message['message']; ?>',
                        
                        icon: '<?php echo e($message['level']); ?>',
                        timer: 8000,
                        position:'top-end',
                        toast:true,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                }, <?php echo e(isset($MESSDELAY)?$MESSDELAY:1); ?>);
            });
        </script>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e(session()->forget('flash_notification')); ?>

<?php /**PATH /home/abayasquare/public_html/new/resources/views/vendor/flash/message.blade.php ENDPATH**/ ?>