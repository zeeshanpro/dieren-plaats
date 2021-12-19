<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
      <link href="<?php echo e(asset( $publicPath . 'front_assets/css/register.css')); ?>" rel="stylesheet">
      <style type="text/css">
          .modal-dialog
          {
            max-width: 450px;
          }
      </style>
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<?php $subHistory = app('App\Repositories\Front\UserRepository'); ?>
<?php

$allSubscriptions=$subHistory->getAllSubscriptions();
?>
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
                                    <h2>Account Type</h2>
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
                            <div class="col-12 pt-3">
                            	<div class="row">
                               <div class="col-12">
                               	
                               			<div class="xxl h5 pt-2 fw-bold">Current Account Type</div>
                               
                               		<div class="xxl fs-5  text-muted">
                               		<?php echo e($usertype??'Un-known'); ?>

                               	</div>

                               	<a href="#" class="btn btn-outline-danger mt-2"  data-bs-toggle="modal" data-bs-target="#changeAccountTypeModal">Change Account Type</a>
                               	<hr style="width: 35%; height: 2px; color: #D8D8D8;" /> 

                               	<div class="xxl h5 pt-2 fw-bold">Membership Fee
                               			</div>
                               
                               		<div class="xxl fs-5  text-muted">
                               		<?php echo e($pricing??'0.00'); ?>

                               	</div>
                               	<hr style="width: 35%; height: 2px; color: #D8D8D8;" /> 

                               	<div class="xxl h5 pt-2 fw-bold"><?php echo e(__('Next Renewal')); ?>

                               			</div>
                               
                               		<div class="xxl fs-5  text-muted">
                               		
                        
				                      <?php echo e($renewal_date??'-'); ?>

				                    
                               	</div>
                               	<hr style="width: 35%; height: 2px; color: #D8D8D8;" /> 



                               </div>
                                </div>
                                <div class="mb-3 pt-2">
                                 


						

                <div class=" xxl text-center h4 py-2 underlineNormal mb-4">
                <?php echo e(__('Renewal History')); ?>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" title="Date Of Transaction">
                                        <?php echo e(__('Date')); ?>

                                        </th>
                                        <th scope="col">
                                        <?php echo e(__('Amount')); ?>

                                        </th>
                                        <th scope="col">
                                            Type
                                        </th>
                                        <th scope="col">
                                        <?php echo e(__('Invoice')); ?>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $__empty_1 = true; $__currentLoopData = $allSubscriptions['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <th scope="row">
                                           <?php echo e(date('d-M-Y',strtotime($subRow->date_of_transaction))); ?>

                                        </th>
                                        <td>
                                            € <?php echo e(number_format($subRow->total/100,2)); ?>

                                        </td>
                                        <td>
                                            Monthly
                                        </td>
                                        <td>
                                           <a href="<?php echo e($subRow->paymentDetails->invoice_pdf??'#'); ?>" target="_blank"> <i class="bi bi-file-pdf h4 text-danger"></i>
                                           </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                      <td colspan="4">
                                    <h3 class="border rounded m-2 p-4 "><?php echo e(__('No Data Available')); ?></h3>
                                      </td></tr>
                                    <?php endif; ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





						

                                </div>
                               
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
               
             
              </div>
          </div>
      </div>
  </div> 
  <div class="modal fade" id="changeAccountTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLabel">Change Account Type</h3>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-2 pe-2">
         <div class="row g-0 justify-content-center">
                <!-- RIGHT PANEL -->
                <div class="col-12 ">
                    <div class="inner_panel">
                      <?php if( $usertype != 'Normal' ){ ?>
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
                        <?php } ?>
                        <?php if( $usertype != 'Shelter' ){ ?>
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
                          
                          <?php } ?>
                          <?php if( $usertype != 'Shelter' ){ ?>
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
                          <?php } ?>
                    </div> 
                </div>
            </div>
      </div>
      <div class="modal-footer">
      <form method="POST" action="<?php echo e(route('proceedToChangeUserType')); ?>" id="frm_update_user_type">
       
         
          <input type="hidden" name="usertypeto" id="usertype" /> 
 <?php echo csrf_field(); ?>
      </form> 
        <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary btn-lg " id="submitUserType"><?php echo e(__('Update')); ?></button>
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
<script type="text/javascript">
     jQuery('#usertype').val("");
     jQuery('input[name="_token"]').val("<?php echo e(csrf_token()); ?>");
       jQuery('#submitUserType').on('click', function(event) {
        event.preventDefault();
        if(jQuery('#usertype').val()=="")
       {
        alert("Please select User Type");
        return;
       }
        jQuery('#frm_update_user_type').submit();
      });
</script>
      <?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/subscriptionhistory.blade.php ENDPATH**/ ?>