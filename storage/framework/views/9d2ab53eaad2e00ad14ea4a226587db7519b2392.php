<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('optional_css'); ?>
<meta content="<?php echo e(csrf_token()); ?>" name="csrf-token"/>
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/my.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-2 left_sidebar col-12">
                <?php echo $__env->make('front.userpanel.sideMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- RIGHT MAIN PANEL -->
            <div class="col-lg-10 col-12">
                <div class="row">
                    
                     
                   <?php echo $__env->make( 'front.layout.components.messageListLeft',[$result,$myAds] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                            
                                
                
                
                 <section id="messageRightSection" style="display:contents">
                    <div class="col-md-7">
                    <h3 class="w-75  p-4 mx-4 text-grey">No Conversation Selected </h3>
                </div>
                 </section>
               
                              
                       
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
    <?php $__env->startSection('optional_scripts'); ?>
<script type="text/javascript">
    var APP_URL="<?php echo e(url('/')); ?>";
</script>
<script src="<?php echo e(asset( $publicPath . 'front_assets/js/messaging.js')); ?>">
</script>
<script type="text/javascript">
   jQuery(document).ready(function() {
<?php if(isset($adId)): ?>
fetch_message_first_time(<?php echo e($adId??'0'); ?>, <?php echo e($oldMsgId); ?>);
<?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/messages.blade.php ENDPATH**/ ?>