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
                                    <h2><?php echo e(__('Password settings')); ?></h2>
                                </div>
                            </div>
                          </div>
                          <div class="row">
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
                            <div class="col-6 pt-4">
                              <form method="post" action="<?php echo e(route('update_logindetails')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3 pt-2">
                                  <label for="currentPassword" class="form-label">Current Password</label>
                                  <input type="password" class="form-control" id="currentPassword" name="currentpass">
                                </div>
                                <div class="mb-3 pt-2">
                                  <label for="newpass" class="form-label">New Password</label>
                                  <input type="password" class="form-control" id="newpass" name="newpass">
                                </div>
                                <div class="mb-3 pt-2">
                                  <label for="newpass_confirmation" class="form-label">Confirm Password</label>
                                  <input type="password" class="form-control" id="newpass_confirmation" name="newpass_confirmation">
                                </div>
                                <button type="submit" class="btn btn-info btn-lg btn-lg-xl mt-3">Reset</button>
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

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/pwdsetting.blade.php ENDPATH**/ ?>