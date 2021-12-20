
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
                            <h3>Login to Dierenplaats</h3>
                            <p><?php echo e(__("You don't have an account?")); ?> <a href="<?php echo e(route('register')); ?>" class="red"><strong><?php echo e(__('Create a free account')); ?></strong></a></p>
                            <?php $__errorArgs = ['msg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <form method="post" action="/login" >
                            <?php echo csrf_field(); ?>
                              <div class="mb-3 mt-4">
                                <label for="exampleInputEmail1" class="form-label"><?php echo e(__('Email address')); ?></label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"><?php echo e(__('Password')); ?></label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                              </div>
                              <div class="row">
                                  <div class="col">
                                    <div class="mb-3 form-check">
                                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                  </div>
                                  <div class="col text-end">
                                      <a href="<?php echo e(route('show_forgot_password')); ?>" class="grey"><?php echo e(__('Forgot Password?')); ?></a>
                                  </div>
                              </div>
                              <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg"><?php echo e(__('Login')); ?></button>
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
<?php echo $__env->make('front/layout/registerLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.4\htdocs\dieren-plaats\resources\views/front/login.blade.php ENDPATH**/ ?>