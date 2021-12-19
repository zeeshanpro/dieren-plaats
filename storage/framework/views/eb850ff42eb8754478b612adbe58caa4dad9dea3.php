<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col">
                  <h3><?php echo e(__('Add new ad')); ?></h3>
              </div>
          </div>
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2><?php echo e(__('Preview')); ?></h2>
                                </div>
                                <div class="col text-end text-grey">
                                <?php echo e(__('Step')); ?>: 4/4
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                                  <!-- PRODUCT DETAIL PANEL -->
                                  <div class="product_detail_panel pb-5">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                              <div class="carousel-inner">
                                              <?php if(isset( $adData->adImages )): ?>
                                                <?php $__currentLoopData = $adData->adImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>">
                                                    <img src="<?php echo e(url('storage/app/public/uploads/ads/'. $filename->filename)); ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <?php endif; ?>
                                              </div>
                                              <div class="carousel-indicators">
                                              <?php if(isset( $adData->adImages )): ?>
                                                <?php $__currentLoopData = $adData->adImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo e($loop->iteration - 1); ?>" class="<?php if($loop->first): ?> active <?php endif; ?>" aria-current="true" aria-label="Slide <?php echo e($loop->iteration); ?>">
                                                    <img src="<?php echo e(url('storage/app/public/uploads/ads/thumb/'. $filename->filename)); ?>" class="d-block" alt="...">
                                                </button>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                              <?php echo date('M d, Y', strtotime( $adData['created_at'] ) ); ?>
                                            </div>
                                            <h6 class="text-grey"><?php echo e(__('Pet info')); ?></h6>
                                            <?php 
                                                $displayedAttributes = array();
                                                $firstIteration = true;
                                            ?>
                                            <?php $__currentLoopData = $adData->adSelectedAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeAndOptions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </div>
                                            <h6 class="text-grey mt-4"><?php echo e(__('Description')); ?></h6>
                                            <div class="desc">
                                            <?php echo e($adData->desc); ?>

                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <!-- PRODUCT DETAIL PANEL ENDS -->

                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                
              </div>
              
             

              <div class="col-md-3 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info">
                      <form method="post" action="<?php echo e(route('publishad', [ 'adId' => $adData->id ] )); ?>">
                        <div class="row">
                          <div class="col">
                            <div class="button_block">
                                <div class="d-grid gap-2">
                                  <?php echo csrf_field(); ?>
                                  <input type="hidden" name="adId" value="<?php echo e($adData->id); ?>" />
                                  <input type="submit" class="btn btn-primary btn-lg" name="Publish" value="<?php echo e(__('Publish')); ?>" />
                                  <!-- <a href="#" class="btn btn-primary btn-lg"><?php echo e(__('Publish')); ?></a> -->
                                  <a href="<?php echo e(route('showattributespage', [ 'adId' => $adData->id ] )); ?>" class="btn btn-info btn-lg"><?php echo e(__('Back')); ?></a>
                                  <a href="<?php echo e(route('showMyAds')); ?>" class="btn btn-lg"><?php echo e(__('Save as draft')); ?></a>
                                </div>  
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-check border-top-grey pt-4 mt-2">
                                  <input class="form-check-input" type="checkbox" value="1" name="promotead" id="flexCheckChecked" >
                                  <label class="form-check-label" for="flexCheckChecked">
                                    <?php echo e(__("Promote your ad as 'top ad' for only €1 (7days).")); ?> 
                                    <a target="_blank" href="/benefit_of_paid_ads" class="grey">Read more</a>
                                  </label>
                                </div>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>  
                </div>
              </div>

              

          </div>
      </div>
  </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/ad/ad_preview.blade.php ENDPATH**/ ?>