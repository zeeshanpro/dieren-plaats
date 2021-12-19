<div class="col-12">
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(Session::has('message')): ?>
   <div class="alert alert-info"><?php echo Session::get('message'); ?></div>
<?php endif; ?>
</div><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/components/notification.blade.php ENDPATH**/ ?>