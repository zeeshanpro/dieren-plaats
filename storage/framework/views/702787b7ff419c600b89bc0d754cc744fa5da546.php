<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
           
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-12">
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
                            <div class="col-7 pt-3">
                                <h6><?php echo e(__('Happy to hear from you')); ?></h6>
                                <form method="post" action="<?php echo e(route('website_save_contactus')); ?>">
                                 <?php echo csrf_field(); ?>
                                  <div class="mb-3 pt-2">
                                  <label for="name" class="form-label"><?php echo e(__('Name')); ?></label>
                            <input type="mane" class="form-control" id="name" name="name" value="<?php echo e(old('name')??''); ?>" placeholder="<?php echo e(__('Enter Your Name')); ?>">
                              </div>
                                <div class="mb-3 pt-2">
                                  <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')??''); ?>" placeholder="<?php echo e(__('Enter Email Address')); ?>">
                              </div>

                                <div class="mb-3 pt-2">
                                  <label for="contactus" class="form-label"><?php echo e(__('Your Message')); ?></label>
                            <textarea class="form-control" id="message" rows="6" name="message"><?php echo e(old('message')??''); ?></textarea>
                              </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-3">Submit</button>
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

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/contactus.blade.php ENDPATH**/ ?>