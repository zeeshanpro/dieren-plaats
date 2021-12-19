<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('container'); ?>
<div class="register_page">
      <div class="container">
          <div class="main_panel">
            <div class="row g-0">
                <!-- LEFT PANEL -->
                <div class="col-md-6 left_panel d-none d-md-block">
                    <h3>Om je op weg te helpen bij de aanschaf van een dier is dierenplaats in het leven geroepen. Dierenplaats is het platform waarop dieren gekocht en verkocht kunnen worden. Zo ben jij er zeker van dat jouw dier bij een goed baasje terecht komt en andersom!</h3>
                </div>

                <!-- RIGHT PANEL -->
                <div class="col-md-6 right_panel">
                    <div class="inner_panel">
                          <div class="max_width">
                            <h3>Wachtwoord Dierenplaats resetten</h3>
                            <p><?php echo e(__("You don't have an account?")); ?> <a href="<?php echo e(route('register')); ?>" class="red"><strong><?php echo e(__('Create a free account')); ?></strong></a></p>
                            <?php $__errorArgs = ['msg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="row"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?></div>
                            <form method="post" action="<?php echo e(route('send_forgot_password_email')); ?>" >
                            <?php echo csrf_field(); ?>
                              <div class="mb-3 mt-4">
                                <label for="exampleInputEmail1" class="form-label"><?php echo e(__('Email address')); ?></label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                              </div>
                              
                              
                              <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg">Reset</button>
                              </div>
                            </form>
                            <div class="or">
                                <span>Or</span>
                            </div>
                            <a href="<?php echo e(route('overtogoogle')); ?>" class="continue_with mb-3"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/google-icon.png')); ?>" /> Continue with Google</a>
                            <!-- <a href="#" class="continue_with"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/facebook-icon.png')); ?>" /> Continue with Facebook</a> -->
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/registerLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/forgot_password.blade.php ENDPATH**/ ?>