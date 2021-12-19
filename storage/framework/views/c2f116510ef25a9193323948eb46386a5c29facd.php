<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('showMiddleBar','true'); ?>
<?php $__env->startSection('optional_css'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('container'); ?>
<!--============== SEARCH BY TYPE STARS HERE ==============-->
<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col-xs-5">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-info d-block d-md-none mb-4" data-bs-toggle="modal" data-bs-target="#filters_menu">
            <i class="bi bi-funnel-fill me-1"></i> Filters
          </button>
        </div>  
              <div class="col-md-3 col-lg-2 left_sidebar d-none d-md-block" id="desktopFilter">
                  <h2><?php echo e(__('Filter by')); ?></h2>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          <?php echo e(__('Price')); ?>

                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="0" data-maxrange="100"  type="checkbox" name="pricerange[]"  id="pricerange_100" data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_100">
                                €0 - €100.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="100" data-maxrange="200" type="checkbox"  name="pricerange[]" id="pricerange_200"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_200">
                                €100.00 - €200.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="200" data-maxrange="300"  type="checkbox"  name="pricerange[]" id="pricerange_300"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_300">
                                €200 - €300
                            </label>
                          </div>
                          <div class="row g-0 range pt-2">
                            <div class="col">
                              <input type="text" class="form-control " id="minrangetext" placeholder="€">
                            </div>
                            <div class="col-1 text-center">-</div>
                            <div class="col">
                              <input type="text" class="form-control " id="maxrangetext" placeholder="€">
                            </div>
                            <div class="col-1"><button id="customPrice"><i class="bi bi-chevron-right"></i></button></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- kinds -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <?php echo e(__('kind')); ?>

                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">
                        <?php $kindObj = app('App\Repositories\Front\KindRepository'); ?>
                        <?php
                            $kindResults = $kindObj->listWithCountAllUsers();

                        ?>
                        <!--  -->
                          <?php if( $kindResults['code'] == 200 ): ?>
                              <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="form-check">
                                <input class="form-check-input filter filterKind" data-filter_column="kind" name="kind" value="<?php echo e($row->id); ?>" type="radio" id="<?php echo e($row->id); ?>"  data-belongs_to_attribute="Kind">
                                <label class="form-check-label" for="<?php echo e($row->id); ?>">
                                <?php echo e($row->title); ?> <span>(<?php echo e($row->kind_ads_count??'0'); ?>)</span>
                                </label>
                              </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>


                    <?php $adAttributeObj = app('App\Repositories\Front\AdAttributeRepository'); ?>
                    <?php
                   
                    
                        $attributesResults = $adAttributeObj->listAttributes();
                        //dd($attributesResults);
                    ?>  
                    <?php $__currentLoopData = $attributesResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($attribute->ad_attributeAdAttributeOptions)==0): ?>
                    <?php continue; ?>
                    <?php endif; ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <?php echo e($attribute->title); ?>


                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">

                        <?php $__currentLoopData = $attribute->ad_attributeAdAttributeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeValues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="options" type="checkbox" value="<?php echo e($attributeValues->id); ?>" id="options_<?php echo e($attributeValues->id); ?>" data-belongs_to_attribute="<?php echo e($attribute->title??''); ?>">
                                <label class="form-check-label" for="options_<?php echo e($attributeValues->id); ?>">
                                    <?php echo e($attributeValues->title); ?> <span>(<?php if(isset( $attributesResults['arrayOfCountByOptions'][$attributeValues->id])): ?>
                                      <?php echo e($attributesResults['arrayOfCountByOptions'][$attributeValues->id]); ?>

                                      <?php else: ?>
                                      0
                                      <?php endif; ?>
                                      )
                                    </span>
                                </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                  </div>
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.loader','data' => []]); ?>
<?php $component->withName('loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                  <div class="col">
                    <?php if(isset($query) and trim($query)!=""): ?>
                      <h3><?php echo e(__('Showing results for')); ?> <span class="text-primary">"<?php echo e($query??''); ?>"</span></h3>
                      <?php endif; ?>
                      <p class="text-grey"><?php echo e($result->currentPage()); ?> of <?php echo e($result->lastPage()); ?> <?php echo e(Str::plural('Page', $result->lastPage())); ?>

</p>
                  </div>
                  <div class="col d-flex justify-content-end">
                   <div class="mb-3 pt-2 w-50">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="dropsort" id="dropsort">
                                  <option selected="" value="null"><?php echo e(__('Sort by')); ?> </option>
                                  <option value="dateasc"><?php echo e(__('Latest First')); ?></option>
                                  <option value="datedesc"><?php echo e(__('Oldest First')); ?></option>
                                  <option value="priceasc"><?php echo e(__('Price Low - High')); ?></option>
                                  <option value="pricedesc"><?php echo e(__('Price High - Low')); ?></option>
                                </select>
                              </div>
                    
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col" id="ftag">
                    
                      <a href="javascript:void(0);" id="clearall">clear all</a>
                  </div>
                </div>
                
                <?php echo $__env->make('front.layout.components.adListBridge', $result , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

            </div>

              <div class="col-md-1 pt-5 d-none d-md-block">
                  <img src="<?php echo e(asset( $publicPath . 'front_assets/images/advertisement.svg')); ?>" />
              </div>
          </div>
      </div>
  </div> 
  <!--============== SEARCH BY TYPE ENDS HERE ==============-->
    <!-- FILTERS POPUP FOR MOBILE -->
  <div class="modal fade" id="filters_menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Filter Results</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
 <div class="col-md-3 col-lg-2 left_sidebar">
                  <h2><?php echo e(__('Filter by')); ?></h2>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          <?php echo e(__('Price')); ?>

                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="0" data-maxrange="100"  type="checkbox" name="pricerange[]"  id="pricerange_100" data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_100">
                                €0 - €100.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="100" data-maxrange="200" type="checkbox"  name="pricerange[]" id="pricerange_200"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_200">
                                €100.00 - €200.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="200" data-maxrange="300"  type="checkbox"  name="pricerange[]" id="pricerange_300"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_300">
                                €200 - €300
                            </label>
                          </div>
                          <div class="row g-0 range pt-2">
                            <div class="col">
                              <input type="text" class="form-control " id="minrangetext" placeholder="€">
                            </div>
                            <div class="col-1 text-center">-</div>
                            <div class="col">
                              <input type="text" class="form-control " id="maxrangetext" placeholder="€">
                            </div>
                            <div class="col-1"><button id="customPrice"><i class="bi bi-chevron-right"></i></button></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- kinds -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <?php echo e(__('kind')); ?>

                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">
                        <?php $kindObj = app('App\Repositories\Front\KindRepository'); ?>
                        <?php
                            $kindResults = $kindObj->listWithCountAllUsers();

                        ?>
                        <!--  -->
                          <?php if( $kindResults['code'] == 200 ): ?>
                              <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="form-check">
                                <input class="form-check-input filter filterKind" data-filter_column="kind" name="kind" value="<?php echo e($row->id); ?>" type="radio" id="<?php echo e($row->id); ?>"  data-belongs_to_attribute="Kind">
                                <label class="form-check-label" for="<?php echo e($row->id); ?>">
                                <?php echo e($row->title); ?> <span>(<?php echo e($row->kind_ads_count??'0'); ?>)</span>
                                </label>
                              </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>


                    <?php $adAttributeObj = app('App\Repositories\Front\AdAttributeRepository'); ?>
                    <?php
                   
                    
                        $attributesResults = $adAttributeObj->listAttributes();
                        //dd($attributesResults);
                    ?>  
                    <?php $__currentLoopData = $attributesResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($attribute->ad_attributeAdAttributeOptions)==0): ?>
                    <?php continue; ?>
                    <?php endif; ?>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <?php echo e($attribute->title); ?>


                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">

                        <?php $__currentLoopData = $attribute->ad_attributeAdAttributeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeValues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="options" type="checkbox" value="<?php echo e($attributeValues->id); ?>" id="options_<?php echo e($attributeValues->id); ?>" data-belongs_to_attribute="<?php echo e($attribute->title??''); ?>">
                                <label class="form-check-label" for="options_<?php echo e($attributeValues->id); ?>">
                                    <?php echo e($attributeValues->title); ?> <span>(<?php if(isset( $attributesResults['arrayOfCountByOptions'][$attributeValues->id])): ?>
                                      <?php echo e($attributesResults['arrayOfCountByOptions'][$attributeValues->id]); ?>

                                      <?php else: ?>
                                      0
                                      <?php endif; ?>
                                      )
                                    </span>
                                </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                  </div>
              </div>


      </div>
    </div>
    </div>
  </div>



  <!--  Mobile popup ends here -->

<?php $__env->stopSection(); ?>
    <?php $__env->startSection('optional_scripts'); ?>
      <script type="text/javascript">
        var APP_URL="<?php echo e(url('/')); ?>";
      </script>
<script src="<?php echo e(asset( $publicPath . 'front_assets/js/adsaveforlater.js')); ?>"></script>


<script src="<?php echo e(asset( $publicPath . 'front_assets/js/searchadsfilters.js')); ?>"></script>

<script type="text/javascript">
  $(document).ready(function() {

  adListSearchFilter().init("<?php echo e(route('searchads_adlistings')); ?>");
});

    $('#filters_menu').on('show.bs.modal', function (e) {
 $('#desktopFilter').remove();
})

</script>

      <?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/ad/searchads.blade.php ENDPATH**/ ?>