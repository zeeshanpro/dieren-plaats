<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>


<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-3 left_sidebar">
                  <div class="image_box type_3 mb-4">
                    <div class="info">
                        <div class="row">
                        <?php if( $User->usertype != 'Normal' ) {?>
                            <div class="col col-md-4 left-side">
                                <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')); ?>" alt="No Logo">
                            </div>
                            <?php } ?>
                            <div class="col-8 col-md-8">
                                <div class="name">
                                 <?php echo e($Breeder->owner_name ?? $User->name); ?>

                                </div>
                                <?php if( $User->usertype != 'Normal' ) {?>
                                <div class="reviews pb-2">
                                  <?php echo $__env->make( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                  <!-- <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill"></i>  --><span class="text-grey">(<?php echo e($sellerReport['no_of_reviews']??0); ?>)</span>
                                </div>
                                <?php } ?>
                                <span class="badge bg-info"><?php echo e($User->usertype ?? 'No User'); ?></span>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col">
                                <div class="stats">
                                    <?php echo e($User->user_ads_count ?? '0'); ?> <span class="text-grey">Ad</span>
                                </div>
                            </div>
                            <div class="col-8">
                              <div class="stats">
                              <?php echo e($views ?? '0'); ?> <span class="text-grey">View</span>
                            </div>
                          </div>
                        </div>
                        <?php if( $User->usertype != 'Normal' ) {?>
                        <div class="row">
                            <div class="col pt-3">
                                <p><?php echo e($Breeder->compay_about ??'Nee '. __("Description").' Added'); ?></p>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                          <div class="col">
                          <?php if( $User->usertype != 'Normal' ) {?>
                              <div class="feature_list pb-2">
                                <img src="<?php echo e(asset('front_assets/images/paw-grey.svg')); ?>" />  <?php echo e($Breeder->breederKind->breeder_kindKind->title??'none'); ?>

                              </div>
                             <?php } ?> 
                              <div class="feature_list pb-2">
                                  <i class="bi bi-geo-alt-fill pe-2"></i> 
                                  <?php
                                  $address = '';
                                  if( isset( $Breeder->street ) )
                                    $address = $Breeder->street.', ';
                                  if( isset( $Breeder->city ) )
                                    $address .= $Breeder->city.', ';
                                  if(isset($Breeder->country))
                                    $address .= $Breeder->country.'';
                                    else
                                    $address.="Netherland";
                                ?>
                                <?php echo e($address); ?>

                              </div>
                              <?php if( $User->usertype != 'Normal' ) {?>
                              <div class="feature_list pb-2">
                                <i class="bi bi-link-45deg pe-2"></i> <a href="<?php echo e($Breeder->website??'#'); ?>" target="_blank"><?php echo e($Breeder->website ?? 'No Website'); ?></a>
                              </div>
                              <?php } ?>
                              <div class="feature_list">
                                <i class="bi bi-telephone-fill pe-2"></i> <?php echo e($Breeder->phone ?? 'No Telefoonnummer'); ?>

                              </div>
                          </div>
                        </div>
                        <?php if( $User->usertype != 'Normal' ) {?>
                        <div class="row">
                          <div class="col">
                              <div class="social_links">
                                  <?php if(isset( $postCreator->fb_url )): ?>
                              <a href="<?php echo e($postCreator->fb_url); ?>"><i class="bi bi-facebook"></i></a>
                              <?php endif; ?>
                              <?php if(isset( $postCreator->insta_url )): ?>
                              <a href="<?php echo e($postCreator->insta_url); ?>"><i class="bi bi-instagram"></i></a>
                              <?php endif; ?>
                              <?php if(isset( $postCreator->linkedin_url )): ?>
                              <a href="<?php echo e($postCreator->linkedin_url); ?>"><i class="bi bi-linkedin"></i></a>
                              <?php endif; ?>
                              </div>
                          </div>
                        </div>
                        <?php } ?>    
                    </div>  
                  </div>
                  
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
              <?php if( $User->usertype != 'Normal' ) {?>
                <div class="row ">
                    <div class="col">
                        <div class="inner_page_top_tabs">
                            <span class="underline">Ads</span>
                            <a href="<?php echo e(url('profile/expectedbabies/'.$User->id.'/'. Str::slug($Breeder->owner_name ?? $User->name) )); ?>"><?php echo e(__('Expected Babies')); ?></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row justify-content-center justify-content-md-start">

                  <?php 
                if( isset( $savedAdsIds ) )
                    $adids = explode(',', $savedAdsIds);
                else
                    $adids = array();
                    ?>
                   
                   <?php $__empty_1 = true; $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                   <?php 
                    $idExist = in_array($row->id , $adids); 
                    ?>
                        <?php echo $__env->make('front.layout.components.subviews.adCell', [ 'row' => $row , 'ifWatchLater'=>$idExist,'cellColumn'=>4, 'myad' => 1 ] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <h3 class="p-5 border rounded"><?php echo e(__('No Ads Available')); ?></h3>
                    <?php endif; ?>




              </div>
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
              <div class="col-auto me-auto">
                  <?php echo e($result->links('pagination::bootstrap-4')); ?>

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
        jQuery(document).ready(function($) {

          $(document).on('change', '.isAdPublished', function(event) {
            event.preventDefault();
            
            togglePublish($(this));

          });


          function togglePublish(element)
          {
            var csrftokenval=$('meta[name="csrf-token"]').attr('content');

    showLoader();
    
   var id=element.data('id');

var jqxhr = $.ajax( {
  url: 'ad/playpause',
  method:"POST",
  data:{"adId":id},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   
    hideLoader();
   if(data.code==201)
   {
   // console.log("success");
   if(data.status=="0")
     { 
     element.prop('checked',false);

         }
    else if(data.status=="1")
{  
 element.prop('checked',true);

}
   }
   else
   {
      element.prop('checked',!element.is(':checked'));
  
   }
    
  })
  .fail(function(data) {
   
     hideLoader();
   element.prop('checked', !element.is(':checked'));
  
  });
          }
          
        });


      </script>
<script src="<?php echo e(asset( $publicPath . 'front_assets/js/adsaveforlater.js')); ?>"></script>
      <?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/myads.blade.php ENDPATH**/ ?>