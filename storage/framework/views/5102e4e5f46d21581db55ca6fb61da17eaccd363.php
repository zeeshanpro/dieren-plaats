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
                            <div class="col col-md-4 left-side">
                                <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')); ?>" alt="No Logo">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="name">
                                 <?php echo e($Breeder->owner_name ?? $User->name); ?>

                                </div>
                                <div class="reviews pb-2">
                                  <?php echo $__env->make( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                  <!-- <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill"></i>  --><span class="text-grey">(<?php echo e($sellerReport['no_of_reviews']??0); ?>)</span>
                                </div>
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
                                200 <span class="text-grey">View</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col pt-3">
                                <p><?php echo e($Breeder->compay_about ??'No Description Added'); ?></p>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col">
                              <div class="feature_list pb-2">
                                <img src="<?php echo e(asset('front_assets/images/paw-grey.svg')); ?>" />  <?php echo e($Breeder->breederKind->breeder_kindKind->title??'none'); ?>

                              </div>
                              <?php
                                  $address = '';
                                  if( isset( $Breeder->street ) )
                                    $address = $Breeder->street.', ';
                                  if( isset( $Breeder->city ) )
                                    $address .= $Breeder->city;
                                  if( strlen($address) > 2 ) { ?>
                                    <div class="feature_list pb-2">
                                        <i class="bi bi-geo-alt-fill pe-2"></i> 
                                      <?php echo e($address); ?>

                                    </div>
                               <?php } 
                                ?>
                                <?php 
                                if( $Breeder->website != '' ){ 
                                  $website = $Breeder->website;
                                  if( substr( $website, 0 , 7 ) == 'http://' or substr( $website, 0 , 8 ) == 'https://' ){
                                    ///$website = $Breeder->website; don't do anything
                                  } else {
                                    $website = 'http://'.$website;
                                  }
                                  ?>  
                              <div class="feature_list pb-2">
                                <i class="bi bi-link-45deg pe-2"></i> <a href="<?php echo e($website); ?>" target="_blank"><?php echo e($Breeder->website ?? 'No Website'); ?></a>
                              </div>
                              <?php } ?>
                              <div class="feature_list">
                                <i class="bi bi-telephone-fill pe-2"></i> <?php echo e($Breeder->phone ?? 'No Telefoonnummer'); ?>

                              </div>
                          </div>
                        </div>
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
                    </div>  
                  </div>
                   <div class="text-center">
                    <?php if(!$alreadyReviewed): ?>
                    <a href="#" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#addReviewModal"><?php echo e(__('Review the Seller')); ?></a>
                    <?php endif; ?>
                  </div>
              </div>
              <!-- RIGHT MAIN PANEL -->
             <div class="col-md-9">
                <div class="row">
                    <div class="col">
                        <div class="inner_page_top_tabs">
                            <a href="<?php echo e(url('profile/'.$userId.'/'. Str::slug($Breeder->owner_name ?? $User->name) )); ?>">Ads</a>
                            <span class="underline"><?php echo e(__('Expected Babies')); ?></span>
                        </div>
                    </div>
         
                </div>
                <div class="row">
                  <div class="col">
                    <div class="table_type_box_header">
                      <div class="row top_panel text-grey">
                          <div class="col">
                              Parent
                          </div>
                          <div class="col">
                          <?php echo e(__('kind')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Race')); ?>

                          </div>
                          <div class="col">
                              Coming <?php echo e(__('Date')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Father')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Mother')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Waiting list')); ?>

                          </div>
                          <div class="col-2">
                          </div>
                      </div>
                  </div>
                  <?php $__empty_1 = true; $__currentLoopData = $expectedBabies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <!-- TABLE TYPE BOX -->
                      <div class="table_type_box">
                          <div class="row top_panel">
                              <div class="col">
                                  <img src="<?php echo e(url('storage/app/public/uploads/expectedbabies/thumb/'.$erow->father_pic)); ?>" class="me-2">
                              </div>
                              <div class="col">
                                <?php echo e($erow->expected_babieKind->title??'None'); ?>

                              </div>
                              <div class="col">
                                  <?php echo e($erow->expected_babieRace->title??'None'); ?>

                              </div>
                              <div class="col">
                                  <?php echo e(date('d/M/Y',strtotime($erow->expected_at))??'None'); ?>

                              </div>
                              <div class="col">
                                <?php echo e($erow->father??'None'); ?>

                              </div>
                              <div class="col">
                                   <?php echo e($erow->mother??'None'); ?>

                              </div>
                              <div class="col">
                              <?php echo e($erow->expected_babie_expected_babies_subscribe_count??'0'); ?>

                              </div>
                             
                                  <div class="col-2 last">
                                    <a href="javascript:void(0);" class="btn btn-success subscribeBtn" data-id="<?php echo e($erow->id); ?>" >
                                    <?php if(in_array($erow->id,$subscribedBabies)): ?>
                                    Subscribed
                                    <?php else: ?>
                                    <?php echo e(__('Subscribe')); ?>

                                    <?php endif; ?>
                                  </a>
                                    <span class="show_more_arrow"></span>
                                </div>
                              
                          </div>
                       

                      </div>
                      <!-- TABLE TYPE BOX END -->
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <h3 class="border rounded p-4 m-2">Nee <?php echo e(__('Expected Babies')); ?> </h3>
                      <?php endif; ?>
            
                  </div>
              </div>
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                       <?php echo e($expectedBabies->links('pagination::bootstrap-4')); ?>

                  </div>
                  <div class="col-auto">
                    
                  </div>
              </div>

            </div>

          </div>
      </div>
  </div> 
  <?php if(!$alreadyReviewed): ?>
  <!-- Modal -->
  <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLabel">Ad Review</h2>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-2 pe-2">
        <div class="seller_name pb-4">

          <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')); ?>" width="60" class="me-4" alt="No Image" />
          <strong><?php echo e(Str::ucfirst($Breeder->owner_name ?? $User->name)); ?></strong>
        </div>  
        <div class="reviews xxl text-center">

          <i class="bi bi-star-fill active  pe-1 ps-1 starrating" data-starcount="1" ></i> 
          <i class="bi bi-star-fill  pe-1 ps-1 starrating"  data-starcount="2" ></i> 
          <i class="bi bi-star-fill  pe-1 ps-1 starrating"  data-starcount="3" ></i> 
          <i class="bi bi-star-fill  pe-1 ps-1 starrating"  data-starcount="4" ></i> 
          <i class="bi bi-star-fill pe-1 ps-1 starrating"  data-starcount="5" ></i>
          <input type="hidden" name="stars" id="starCount" value="1">
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-4 pt-3 ps-2 pe-2">
              <label for="opinion" class="form-label"><?php echo e(__('Your opinion')); ?> <small class="text-success" id="message"></small></label>
              <textarea class="form-control" id="opinion" rows="6"></textarea>
            </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary btn-lg " id="submitRating"><?php echo e(__('Submit')); ?></button>
      </div>
    </div>
    </div>
  </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>
<?php if(!$alreadyReviewed): ?>
<script type="text/javascript">
var csrftokenval=$('meta[name="csrf-token"]').attr('content');
var responsemsg=jQuery("#message");
  jQuery("#submitRating").on('click',function(){
responsemsg.html("");
var StarCount=jQuery("#starCount").val();
var StarOpinion=jQuery("#opinion").val();

var StarForId="<?php echo e($User->id ?? '0'); ?>";

var jqxhr = $.ajax( {
  url: '<?php echo e(url("/createreview")); ?>',
  method:"POST",
  data:{"uid":StarForId,"stars":StarCount,"comment":StarOpinion},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
   // console.log("success");
   responsemsg.html("Successfuly saved");
   }
   else
   {
      addStar(1);
      responsemsg.html(data.message);
   }
    
  })
  .fail(function(data) {
    addStar(1);
    responsemsg.html(data.responseJSON.message);
  
  });


  });

jQuery(".starrating").on('click',function(){
var selectedStar=jQuery(this).data('starcount');
if(selectedStar<2)
{
  selectedStar=1;
}

addStar(selectedStar);
jQuery("#starCount").val(selectedStar);

});

function addStar(sno){
  var cur=null;
$( ".starrating" ).each(function( index ) {
var selectedStar=jQuery(this).data('starcount');
var cur=jQuery(this);
if(selectedStar>1)
cur.removeClass('active');

if(selectedStar<=sno)
{
  cur.addClass('active');
}

});



}
</script>

<?php endif; ?>

<script type="text/javascript">
  
  jQuery(document).on('click', '.subscribeBtn', function(event) {
    event.preventDefault();
    var csrftokenval=$('meta[name="csrf-token"]').attr('content');
    var responsemsgs=jQuery(this);
    
   var id=jQuery(this).data('id');

var jqxhr = $.ajax( {
  url: '<?php echo e(url("expectedad/subscribe")); ?>',
  method:"POST",
  data:{"expectedAdId":id},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
   // console.log("success");
   if(data.msg=="Unsubscribed Successfully")
      responsemsgs.html("<?php echo e(__('Subscribe')); ?>");
    else
    responsemsgs.html("Subscribed");
   }
   else
   {
      
  
   }
    
  })
  .fail(function(data) {
    
  
  
  });

  });

</script>

     
      <?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/profile/breedershelterExpectedBabies.blade.php ENDPATH**/ ?>