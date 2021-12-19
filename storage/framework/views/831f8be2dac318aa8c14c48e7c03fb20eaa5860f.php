<div class="shadow_box d-none d-lg-block">
    <ul class="list-group list-group-flush">
        <li class="list-group-item <?php echo e(request()->routeIs('messages') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('messages')); ?>">
            <?php echo e(__('Messages')); ?>

            </a>
        </li>
        <li class="list-group-item <?php echo e(request()->routeIs('showprofileform') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('showprofileform')); ?>">
                <?php echo e(__('Profile info')); ?>

            </a>
        </li>
        <li class="list-group-item <?php echo e(request()->routeIs('showsavedads') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('showsavedads')); ?>">
                <?php echo e(__('Saved ads')); ?>

            </a>
        </li>
        <li class="list-group-item <?php echo e(request()->routeIs('show_logindetails_form') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('show_logindetails_form')); ?>">
                <?php echo e(__('Password settings')); ?>

            </a>
        </li>
        <li class="list-group-item <?php echo e(request()->routeIs('userpanel_contactus') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('userpanel_contactus')); ?>">
                <?php echo e(__('Contact Us')); ?>

            </a>
        </li>
        <li class="list-group-item">
            
                <a href="<?php echo e(route('show_subscription_history')); ?>">
                <?php echo e(__('Subsctiption')); ?>

            </a>
        </li>
    </ul>
</div>


<?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/sideMenu.blade.php ENDPATH**/ ?>