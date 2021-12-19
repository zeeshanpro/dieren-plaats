<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('container'); ?>

<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col">
                  <h3><?php echo e(__('Add new ad')); ?></h3>
              </div>
          </div>
          <form method="post" action="<?php echo e(route('saveAttributesOptions')); ?>">
            <?php echo csrf_field(); ?>
          <input type="hidden" name="adId" value="<?php echo e($adData->id); ?>" />  
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>More details</h2>
                                </div>
                                <div class="col text-end text-grey">
                                <?php echo e(__('Step')); ?>: 3/4
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                              <div class="add_more_details pb-5">
                              <?php $attributesMaster = app('App\Repositories\Front\AttributesAndOptionsRepository'); ?>
                                <?php
                                    $attributesResults = $attributesMaster->list( $adData->kind_id );
                                ?>
                                <?php $__currentLoopData = $attributesResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="pb-3 pt-4">
                                      <label><?php echo e($row->title); ?></label>
                                    </div> 
                                    
                                      <?php $__currentLoopData = $row->ad_attributeAdAttributeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div class="form-check form-check-inline me-5">
                                            <input class="form-check-input me-3" type="checkbox" <?php if( in_array( $options->id , $selectedAttributes ) ) echo 'checked'; ?> name="options[]" id="option<?php echo e($options->id); ?>" value="<?php echo e($options->id); ?>" />
                                            <label class="form-check-label" for="option<?php echo e($options->id); ?>"><?php echo e($options->title); ?></label>
                                          </div>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
                
              </div>

              <div class="col-md-3 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info">
                      <div class="row">
                        <div class="col">
                            <div class="button_block">
                                <div class="d-grid gap-2">
                                  <input type="submit" class="btn btn-primary btn-lg" name="publish" value="Preview" />
                                  <a href="<?php echo e(route('showAdUpdateForm', [ 'adId' => $adData->id ] )); ?>" class="btn btn-info btn-lg"><?php echo e(__('Back')); ?></a>
                                  <a href="<?php echo e(route('showMyAds')); ?>" class="btn btn-lg"><?php echo e(__('Save as draft')); ?></a>
                                </div>  
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-check border-top-grey pt-4 mt-2">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                  <label class="form-check-label" for="flexCheckChecked">
                                  <?php echo e(__("Promote your ad as 'top ad' for only €1 (7days).")); ?>  <a href="#" class="grey">Read more</a>
                                  </label>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>  
                </div>
              </div>
              <div class="image_box">
                <a href="#"><img src="<?php echo e(url('storage/app/public/uploads/ads/'.$adData->adImages[0]->filename)); ?>"></a>
                <div class="info">
                    <div class="row">
                        <div class="col">
                            <div class="date">
                                <?php echo date('M d, Y', strtotime( $adData['created_at'] ) ); ?>
                            </div>
                            <div class="name">
                                <a href="#"><?php echo e($adData->title); ?></a>
                            </div>
                            <div class="price">
                                <a href="#">€ <?php echo e($adData->amount); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-6">
                        <ul class="detail_list">
                            <li><label><?php echo e(__('kind')); ?></label> <?php echo e($adData->adKind->title); ?></li>
                        </ul>
                      </div>
                      <div class="col col-md-6">
                        <ul class="detail_list">
                            <li><label><?php echo e(__('Rase')); ?></label> <?php echo e($adData->adRace->title); ?></li>
                        </ul>
                      </div>
                    </div>
                </div>  
            </div>
              
          </div>
          </form>
      </div>
  </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/ad/createad_showattributes.blade.php ENDPATH**/ ?>