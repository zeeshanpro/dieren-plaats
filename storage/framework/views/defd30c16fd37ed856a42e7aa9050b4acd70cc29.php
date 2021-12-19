<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-2 left_sidebar">
                    <?php echo $__env->make('front.userpanel.sideMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">

                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2><?php echo e(__('Contact Us')); ?></h2>
                                </div>
                            </div>
                          </div>  
                          <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.notification','data' => []]); ?>
<?php $component->withName('notification'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                          <div class="row">
                            <div class="col-9 pt-3">
                                <h6><?php echo e(__('Happy to hear from you')); ?></h6>
                                
                                <div class="mb-3 pt-2">
                                  <form method="post" action="<?php echo e(route('userpanel_save_contactus')); ?>">
                                    <?php echo csrf_field(); ?>
                                  <label for="contactus" class="form-label"><?php echo e(__('Your Message')); ?></label>
                            <textarea class="form-control" id="message" rows="6" name="message"><?php echo e(old('message')??''); ?></textarea>

                                </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-3"><?php echo e(__('Submit')); ?></button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
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
<script src="<?php echo e(asset( $publicPath . 'front_assets/js/adsaveforlater.js')); ?>"></script>
      <?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/contactus.blade.php ENDPATH**/ ?>