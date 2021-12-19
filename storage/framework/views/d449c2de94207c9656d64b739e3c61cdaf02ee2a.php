<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('container'); ?>
    <div class="register_page" id="step1">
      <div class="container">
          <div class="main_panel mt-3 mt-md-5">
            <div class="row g-0">
                <!-- LEFT PANEL -->
                <div class="col-md-6 left_panel  d-none d-md-block">
                    <h3>Om je op weg te helpen bij de aanschaf van een dier is dierenplaats in het leven geroepen. Dierenplaats is het platform waarop dieren gekocht en verkocht kunnen worden. Zo ben jij er zeker van dat jouw dier bij een goed baasje terecht komt en andersom!</h3>
                </div>
                <!-- RIGHT PANEL -->
                <div class="col-md-6 right_panel">

                  
                    <div class="inner_panel">
                          <div class="row top_panel pb-4">
                            <div class="col">
                                <a href="<?php echo e(url('/')); ?>" class="grey"><i class="bi bi-house-door"></i> HOME</a>
                            </div>
                            <div class="col text-end">
                                1/3
                            </div>
                         </div>
                          <div class="max_width">
                            <h3><?php echo e(__('Register to Dierenplaats')); ?></h3>
                            <p>Heb je al een account bij ons? <a href="<?php echo e(route('login')); ?>" class="red"><strong>Log hier in</strong></a></p>
                            
                              <div class="mb-3 mt-5">
                                <p><?php echo e(__('Select account type')); ?></p>
                              </div>
                          </div>    
                          <div class="select_account_type" data-option="Normal" data-plan="">
                            <div class="row">
                              <div class="col-2 text-center">
                                  <img src="<?php echo e(asset( $publicPath . 'front_assets/images/animal-rights.svg')); ?>" />
                              </div>
                              <div class="col-10">
                                  <h5><?php echo e(__('Normal seller/buyer')); ?></h5>
                                  <p><?php echo e(__('Free to add an advertisement, up to 3')); ?></p>
                              </div>  
                            </div>  
                          </div>
                          <div class="select_account_type" data-option="Shelter" data-plan="price_1K7HkBBuir1vjVYcdajeTyy7"> 
                            <!-- price_1JxxQeCaEIG4B93yXx7Be3mO -->
                            <div class="row">
                              <div class="col-2 text-center">
                                  <img src="<?php echo e(asset( $publicPath . 'front_assets/images/animal-shelter.svg')); ?>" />
                              </div>
                              <div class="col-10">
                                  <h5><?php echo e(__('Animal shelter')); ?></h5>
                                  <p><?php echo e(__('Animal shelter accounts are €1,- each month. They can add unlimited advertisements')); ?></p>
                              </div>  
                            </div>  
                          </div>
                          <div class="select_account_type" data-option="Breeder" data-plan="price_1K7HkuBuir1vjVYcJwPCY5Yq">
                            <!-- price_1JxxPNCaEIG4B93yTxn1GsRe -->
                            <div class="row">
                              <div class="col-2 text-center">
                                  <img src="<?php echo e(asset( $publicPath . 'front_assets/images/breeder-icn.svg')); ?>" />
                              </div>
                              <div class="col-10">
                                  <h5><?php echo e(__('Breeder')); ?></h5>
                                  <p><?php echo e(__('Breeders need to pay €4.95 each month to use this site. They can add unlimited advertisements and they are able to add their breeder info in the account page')); ?></p>
                              </div>  
                            </div>  
                          </div>
                          <div class="max_width">    
                              <div class="d-grid mt-5">
                                <button type="submit" id="step-1-continue" class="btn btn-primary btn-lg"><?php echo e(__('Continue')); ?></button>
                              </div>
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>



     <!-- registration part 2 -->

        <div class="register_page" style="display:none" id="step2">
      <div class="container">
          <div class="main_panel  mt-3 mt-md-5">
            <div class="row g-0">
                <!-- LEFT PANEL -->
                <div class="col-md-6 left_panel d-none d-md-block">
                    <h3>Om je op weg te helpen bij de aanschaf van een dier is dierenplaats in het leven geroepen. Dierenplaats is het platform waarop dieren gekocht en verkocht kunnen worden. Zo ben jij er zeker van dat jouw dier bij een goed baasje terecht komt en andersom!</h3>
                </div>

                <!-- RIGHT PANEL -->
                <div class="col-md-6 right_panel">
                    <div class="inner_panel">
                          <div class="row top_panel pb-4">
                            <div class="col">
                                <a href="#" id="stepback" class="grey"><i class="bi bi-arrow-left"></i> <?php echo e(__('Back')); ?></a>
                            </div>
                            <div class="col text-end">
                                2/3
                            </div>
                         </div>
                          <div class="max_width">
                            <h3><?php echo e(__('Register to Dierenplaats')); ?></h3>
                            <p>Heb je al een account bij ons? <a href="#" class="red"><strong>Log hier in</strong></a></p>
                            <form method="post" action="/registerUser">
                            <?php echo csrf_field(); ?>
                              <div class="mb-3 mt-4">
                                <label for="fullname" class="form-label"><?php echo e(__('Full name')); ?></label>
                                <input type="text" class="form-control" id="fullname" name="name" aria-describedby="emailHelp">
                                 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                              </div>



                              <div class="mb-3 mt-4" id="addressblock">
                                <div class="row">
                                  <div class="col-6">
                                    <label for="street" class="form-label"><?php echo e(__('Street')); ?></label>
                                    <input type="text" class="form-control" id="street" name="street" >
                                  </div>
                                  <div class="col-6">
                                    <label for="city" class="form-label"><?php echo e(__('City')); ?></label>
                                    <input type="text" class="form-control" id="city" name="city" >
                                  </div>
                                  <div class="col-6">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" >
                                  </div>
                                    <div class="col-12">
                                    <label for="country" class="form-label"><?php echo e(__('Country')); ?></label>
                                      <input type="text" class="form-control" id="country" name="country" readonly value="Nederland">
                                  </div>
                                </div>
                              </div>



                              <div class="mb-3 mt-4">
                                <label for="email" class="form-label"><?php echo e(__('Email address')); ?></label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                               <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                              </div>
                              <div class="mb-3">
                                <label for="pass" class="form-label"><?php echo e(__('Password')); ?></label>
                                <input type="password" class="form-control" id="pass" name="password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                              </div>
                              <div class="row">
                                  <div class="col">
                                    <div class="mb-3 form-check">
                                      <input type="checkbox" class="form-check-input" id="terms" name="terms" value="agree">
                                      <input type="hidden" name="usertype" id="usertype" value="<?php echo e(old('usertype')); ?>">
                                      <input type="hidden" name="plan" id="plan" value="<?php echo e(old('plan')); ?>">
                                      <label class="form-check-label" for="terms">Bij het aanmaken van een account ga je akkoord met onze <a target="_blank" href="<?php echo e(url('term_of_service')); ?>">Algemene voorwaarden</a> en <a target="_blank" href="<?php echo e(url('privacy_policy')); ?>"> Pricay policy</a>.</label>
                                    </div>
                                  </div>
                               </div>
                              <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary btn-lg"><?php echo e(__('Continue')); ?></button>
                              </div>
                            </form>
                            
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>
     <?php $__env->stopSection(); ?>
    <?php $__env->startSection('optional_scripts'); ?>
    <?php if($errors->any()): ?>

    <script type="text/javascript">
      jQuery(document).ready(function($) {
        jQuery('#step-1-continue').click();
      });
    </script>
    
    <?php endif; ?>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/registerLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/register.blade.php ENDPATH**/ ?>