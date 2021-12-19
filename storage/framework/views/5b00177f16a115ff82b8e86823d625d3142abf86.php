<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
      

        <style>
            div#social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            div#social-links ul li {
                display: inline-block;
            }          
            div#social-links ul li a {
                padding: 20px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 30px;
                color: #222;
                background-color: #ccc;
            }
        </style>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3 pb-5">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-8 col-lg-9">
                  <!-- PRODUCT DETAIL PANEL -->
                  <div class="product_detail_panel pb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="overflow: hidden;">
                              <div class="carousel-inner" style="">
                                 <?php if(isset( $adData->adImages ) and count( $adData->adImages ) > 0 ): ?>
                                                <?php $__currentLoopData = $adData->adImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if( file_exists( 'storage/app/public/uploads/ads/thumb/'.$filename->filename ) ) {?>
                                                    <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>" style="max-height:550px;overflow: hidden;">
                                                    <img src="<?php echo e(url('storage/app/public/uploads/ads/thumb/'. $filename->filename)); ?>" class="d-block " alt="<?php echo e($adData->title); ?>"  style="width:400px;height:400px;object-fit:cover">
                                                    </div>
                                                <?php } else if( count( $adData->adImages) == 1 ) { ?>
                                                  <div class="carousel-item active " style="max-height:550px;overflow: hidden;">
                                                    <img src="<?php echo e(asset( 'front_assets/images/noimage.jpg' )); ?>" class="d-block " alt=""  style="width:400px;height:400px;object-fit:cover" />
                                                  </div>
                                                <?php } ?>    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php else: ?>
                                  <div class="carousel-item active" style="max-height:550px;overflow: hidden;">
                                    <img src="<?php echo e(asset( 'front_assets/images/noimage.jpg' )); ?>" class="d-block " alt="<?php echo e($adData->title); ?>"  style="width:400px;height:400px;object-fit:cover" />
                                  </div>
                                  <?php endif; ?>
                              </div>
                              <div class="carousel-indicators">
                                  <?php if(isset( $adData->adImages ) and count( $adData->adImages ) > 0 ): ?>
                                                <?php $__currentLoopData = $adData->adImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if( file_exists( 'storage/app/public/uploads/ads/thumb/'.$filename->filename ) ) {?>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo e($loop->iteration - 1); ?>" class="<?php if($loop->first): ?> active <?php endif; ?>"  aria-label="Slide <?php echo e($loop->iteration); ?>">
                                                    <img src="<?php echo e(url('storage/app/public/uploads/ads/thumb/'. $filename->filename)); ?>" class="d-block" alt="...">
                                                </button>
                                                <?php } else if( count( $adData->adImages ) == 1 ) { ?>
                                                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"  aria-label="Slide 0">
                                                    <img src="<?php echo e(asset( 'front_assets/images/noimage.jpg' )); ?>" class="d-block " alt="..." />
                                                  </button>
                                                <?php } ?>    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php else: ?>
                                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="active"  aria-label="Slide 1">
                                    <img src="<?php echo e(asset( 'front_assets/images/noimage.jpg' )); ?>" class="d-block " alt="..." />
                                  </button>          
                                    <?php endif; ?>
                              </div>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
                            </div>
                        </div>
                        <div class="col-md-5 desc_panel">
                            <h2><?php echo e($adData->title); ?></h2>
                            <div class="price">
                                €<?php echo e($adData->amount); ?>

                            </div>
                            <div class="date text-grey pb-3">
                              <?php echo e(date('M d, Y', strtotime( $adData['created_at'] ) )); ?> 
                            </div>
                            <h6 class="text-grey"><?php echo e(__('Pet info')); ?></h6>
                            <?php 
                                                $displayedAttributes = array();
                                                $firstIteration = true;
                                            ?>
                                            <?php $__empty_1 = true; $__currentLoopData = $adData->adSelectedAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeAndOptions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php
                                                    $attributeTitle = $attributeAndOptions->ad_selected_attributeAd_attribute_option->ad_attribute_optionAd_attribute->title;
                                                    if( !in_array( $attributeTitle , $displayedAttributes ) ){
                                                        $displayedAttributes[] = $attributeTitle;
                                                        if( $firstIteration == false )
                                                            echo '</div>';
                                                        else 
                                                            $firstIteration = false ;    
                                                        ?>

                           <div class="feature_list">
                                                        <img src="<?php echo e(asset( $publicPath . 'front_assets/images/paw-red.svg')); ?>" /> 
                                                        <?php echo e($attributeAndOptions->ad_selected_attributeAd_attribute_option->ad_attribute_optionAd_attribute->title); ?> :
                                                        <?php echo e($attributeAndOptions->ad_selected_attributeAd_attribute_option->title); ?>, 
                                                <?php   } else { ?>
                                                            <?php echo e($attributeAndOptions->ad_selected_attributeAd_attribute_option->title); ?>

                                                <?php    }
                                                ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <div class="feature_list"> No options
                                            <?php endif; ?>
                            </div>
                          
                            <h6 class="text-grey mt-4"><?php echo e(__('Description')); ?></h6>
                            <div class="desc">
                              <?php echo e($adData->desc??'No Description.'); ?>

                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- PRODUCT DETAIL PANEL ENDS -->
              </div>
              <div class="col-md-4 col-lg-3 left_sidebar">
                <div class="image_box type_3 mb-4 product_page_seller_info">
                  <div class="info">
                      <div class="row">
                        <div class="col">
                            <h2 class="mb-3 seller_name"><?php echo e(__('Seller info')); ?></h2>
                            <span class="badge bg-info bg-secondary mb-1"><?php echo e($adData->adUser->usertype); ?></span>
                            <?php
                              if( $adData->adUser->usertype == 'Normal' ){
                                $name = $adData->adUser->name;
                              } else {
                                $name = ($adData->adUser->Breeder->company_name ?? $adData->adUser->Breeder->owner_name);
                              }
                            ?>
                            <a href="<?php echo e(route('showProfile', [ 'userId' => $adData->adUser->id, 'title' => Str::slug($name) ] )); ?>">
                              <h2 class="mb-0"><?php echo e($name); ?></h2>
                            </a>
                             <?php if($adData->adUser->usertype=="Shelter" || $adData->adUser->usertype=="Breeder"): ?>
                            <div class="reviews pb-2" title="Average Rating: <?php echo e($sellerReport['avg_rating']??'1'); ?>">
                              <?php echo $__env->make( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                              <span class="text-grey">(<?php echo e($sellerReport['no_of_reviews']??0); ?>)</span>
                            </div>
                             <?php endif; ?>
                             <a href="<?php echo e(route('showProfile', [ 'userId' => $adData->adUser->id, 'title' => Str::slug($name) ] )); ?>">
                            <div class="ads_numbers text-black">
                                <i class="bi bi-window me-2"></i> <?php echo e($postCreator->user_ads_count); ?> Ads
                            </div>
                            </a>

                            <div class="button_block mt-3 pt-4">
                                <div class="d-grid gap-2">
                                  <a href="javascript:void(0);" class="btn btn-info btn-lg act_saveme_addetail" data-id="<?php echo e($adData->id); ?>"><i class="bi bi-heart-fill me-1 <?php if(isset($watchLater) and $watchLater == 1) echo 'text-red'; else echo 'text-grey'; ?>"></i> <span>Save<?php if(isset($watchLater) and $watchLater == 1) echo "d"; ?> for later</span></a>
                                  <a href="<?php echo e(route('messages', [ 'adId' => $adData->id ])); ?>" class="btn btn-primary btn-lg"><?php echo e(__('Contact the seller')); ?></a>
                                </div>  
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="views flex-start" style="font-size:15px;">
                                    <i class="bi bi-heart-fill me-2 text-grey"></i> Saved: 
                                    <?php
                                    if( isset( $reporting ) )
                                      echo $reporting->cntLikes;
                                    else 
                                      echo '0';
                                    ?> 
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="views" style="font-size:15px;">
                                      <i class="bi bi-eye-fill me-2 text-grey"></i> <?php echo e(__('Viewed')); ?>:
                                      <?php
                                    if( isset( $reporting ) )
                                      echo $reporting->cntView;
                                    else 
                                      echo '0';
                                    ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>  
                </div>
                <div class="image_box type_3 mb-4">
                  <div class="info">
                      <div class="row">
                        <div class="col">
                            Contact Info
                            <div class="feature_list pb-2 pt-3">
                                <i class="bi bi-geo-alt-fill pe-2"></i>
                                <?php
                                  $address = '';
                                  if( isset( $postCreator->Breeder->street ) )
                                    $address = $postCreator->Breeder->street.', ';
                                  if( isset( $postCreator->Breeder->city ) )
                                    $address .= $postCreator->Breeder->city.', ';
                                  if( isset( $postCreator->Breeder->country ) )
                                    $address .= $postCreator->Breeder->country.'';
                                    else
                                    $address.="Not Mentioned";
                                ?>
                                <?php echo e($address); ?>

                            </div>
                            <?php if(isset( $postCreator->website )): ?>
                                  <?php
                                    $website = $postCreator->website;
                                    if( substr( $website, 0, 4 ) != 'http' ){
                                      $website = 'http://' . $website;
                                    }
                                  ?>
                            <div class="feature_list pb-2">
                              <i class="bi bi-link-45deg pe-2"></i> <a target="_blank" href="$website"><?php echo e($postCreator->website); ?></a>
                            </div>
                            <?php endif; ?>
                            <?php if(isset( $postCreator->phone )): ?>
                            <div class="feature_list">
                              <i class="bi bi-telephone-fill pe-2"></i> <?php echo e($postCreator->phone); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <div class="social_links">
                            <?php if(isset( $postCreator->fb_url )): ?>
                                <a href="<?php echo e($postCreator->fb_url); ?>" target="_blank"><i class="bi bi-facebook"></i></a>
                            <?php endif; ?>    
                            <?php if(isset( $postCreator->insta_url )): ?>
                                <a href="<?php echo e($postCreator->insta_url); ?>" target="_blank"><i class="bi bi-instagram"></i></a>
                            <?php endif; ?>        
                            <?php if(isset( $postCreator->linkedin_url )): ?>    
                                <a href="<?php echo e($postCreator->linkedin_url); ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                            <?php endif; ?>
                            </div>
                        </div>
                      </div>    
                  </div>  
                </div>
                <div class="share_ad">
                  <div class="mb-2">
                    <span><?php echo e(__('Share the ad')); ?></span>
                  </div>
                  
                  <a href="<?php echo e($shareComponent['facebook']); ?>" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="<?php echo e($shareComponent['twitter']); ?>" target="_blank"><i class="bi bi-twitter"></i></a>
                  <a href="<?php echo e($shareComponent['whatsapp']); ?>" target="_blank"><i class="bi bi-whatsapp"></i></a>
                  <a href="<?php echo e($shareComponent['linkedin']); ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                </div>

            </div>
          </div>


                    
                  
          <?php if($adData->adUser->usertype=="Shelter" || $adData->adUser->usertype=="Breeder"): ?>
          <div class="row">
              <div class="col">
                  <!-- PRODUCT DETAIL REVIEWS -->

                  <div class="review_section pt-4 mt-5 pb-5">
                    <div class="row">
                        <div class="col-7">
                              <div class="row">
                                  <div class="col">
                                      <h3>Reviews</h3>
                                  </div>
                                  
                                  <div class="col text-end">
                                    <?php if(!$alreadyReviewed): ?>
                                        
                                        <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
                                          <a href="#" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#addReviewModal"><?php echo e(__('Review the Seller')); ?></a>
                                        <?php else: ?>  
                                          <?php if(auth()->guard()->guest()): ?>
                                          <a href="<?php echo e(route('login')); ?>" class="btn btn-info btn-lg" ><?php echo e(__('Review the Seller')); ?></a>
                                          <?php endif; ?>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                  </div>
                              </div>
                              <!-- REVIEW -->


                                <?php $__empty_1 = true; $__currentLoopData = $breederReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                              <div class="review_box">
                                  <div class="row pt-4">
                                      <div class="col">
                                      <a href="<?php echo e(route('showProfile', ['userId' => $review->breeder_reviewUser->id, 'title' => $review->breeder_reviewUser->name] )); ?>">
                                          <div class="user">
                                            <?php if($review->breeder_reviewUser->Breeder->logo): ?>
                                            <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$review->breeder_reviewUser->Breeder->logo)); ?>" class="user" />
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('front_assets/images/default.jpg')); ?>" class="user" />
                                            <?php endif; ?> 
                                            <?php echo e($review->breeder_reviewUser->name??'Unknown'); ?>

                                          </div>  
                                        </a>  
                                      </div>
                                      <div class="col text-end">
                                        <span class="text-grey"><?php echo e(date('j/m/Y', strtotime($review->created_at))??'Unknown'); ?></span>
                                    </div>
                                  </div>
                                  <div class="row pt-2">
                                      <div class="col">
                                        <div class="reviews pb-2">
                                          <?php echo $__env->make( 'front.layout.components.stars',['stars'=>$review->rating??1] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="row pt-2">
                                    <div class="col text-grey">
                                      <p><?php echo e($review->opinion??'No Comment Added'); ?></p>
                                    </div>
                                </div>
                              </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                  <h3 class="p-4 border rounded mt-2">No Reviews Yet</h3>
                                  <?php endif; ?>





                             
                            <!-- REVIEW -->
                            <div class="review_box">
                              <div class="row pt-4">
                                  <div class="col">
                                      <a href="<?php echo e(url('ad/'. $adData->id  .'/'.Str::slug($adData->title).'/allreviews')); ?>" class="black"><?php echo e(__('See more')); ?></a>  
                                  </div>
                              </div>
                          </div>
                              
                        </div>
                    </div>
                  </div>  
                  <!-- PRODUCT DETAIL REVIEWS ENDS-->
              </div>
          </div>
          <?php endif; ?>
      </div>
  </div> 
   <?php if(!$alreadyReviewed): ?>
   <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
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

          <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$postCreator->Breeder->logo??'')); ?>" width="60" class="me-4" alt="No Image" />
          <strong><?php echo e(Str::ucfirst($postCreator->Breeder->owner_name ?? $adData->adUser->name)); ?></strong>
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

      var StarForId="<?php echo e($postCreator->Breeder->id ?? '0'); ?>";

      var jqxhr = $.ajax( {
          url: APP_URL+"/createreview",
          method:"POST",
          data:{"uid":StarForId,"stars":StarCount,"comment":StarOpinion},
          headers: { 'X-CSRF-TOKEN': csrftokenval }
        })
        .done(function(data) {
          if(data.code==201)
          {
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
var APP_URL = <?php echo json_encode(url('/')); ?>

</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/share.js')); ?>"></script>
<script src="<?php echo e(asset( $publicPath . 'front_assets/js/adsaveforlater.js')); ?>"></script>
<script type="text/javascript">
  var totalNumberOfItems = $(".carousel-item").length;
  if( totalNumberOfItems > 4 ){
    var movetoLeftFix = ( totalNumberOfItems - 4 ) * 45;
    $('.carousel-indicators').css("left", movetoLeftFix + "px");
  }
  var ifFirstTime = 1;
  $('#carouselExampleIndicators').on('slid.bs.carousel', function(event) {
      currentIndex = $('button.active').index() + 1;
      var totalNumberOfItems = $(".carousel-item").length;
      var moveToRight = 0;
      console.log(currentIndex + " " + event.direction );
      if( totalNumberOfItems > 4 ){
          if( event.direction == 'left' ){ // by default it moves in left direction
            if( currentIndex > 4 )
            {
                if( ( currentIndex + 1 ) != totalNumberOfItems ) {
                  $('.carousel-indicators').css("left", "-=100");
                } else {
                  if( totalNumberOfItems < 8 ) {
                    $('.carousel-indicators').css("left", "-=100");
                  }
                }
            }
            else
            { 
              if( currentIndex == 1 && ifFirstTime == 0 ){
                  var movetoLeftFix = ( totalNumberOfItems - 4 ) * 45;
                  $('.carousel-indicators').css("left", movetoLeftFix + "px");
              } else {
                  ifFirstTime = 0;
              }
                //$('.carousel-indicators').css("left", "300px");
            }
          } else { // means the left arrow button is clicked
            if( currentIndex == totalNumberOfItems ) { // means by clicking the left the carousel has reached the last image
              moveToRight = ( totalNumberOfItems - 4 ) * -50;
              //console.log( "moving to the right at " + moveToRight );
              $('.carousel-indicators').css("left", moveToRight + "px");
            } else {
              if( currentIndex >= 4 )
              {
                  $('.carousel-indicators').css("left", "+=100");
              }
              else if( currentIndex == 3 )
              {
                  //$('.carousel-indicators').css("left", "350px");
              }
            }
          } 
        
      } else {
        //$('.carousel-indicators').css("left", "0px");
      }
  });

</script>
      <?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/ad/ad_detail.blade.php ENDPATH**/ ?>