<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('optional_css'); ?>
<meta content="<?php echo e(csrf_token()); ?>" name="csrf-token"/>
<link href="<?php echo e(asset( $publicPath . 'front_assets/css/my.css')); ?>" rel="stylesheet">
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
    <div class="inner_page_content_area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-12">
                   <h2 class="border rounded  p-5 text-center">Binnenkort beschikbaar !</h2>
                </div>
             
            </div>
        </div>
    </div>
    <!-- FILTERS POPUP FOR MOBILE -->
    <div aria-hidden="true" aria-labelledby="staticBackdropLabel" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="filters_menu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Filter Results
                    </h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-3 col-lg-2 left_sidebar">
                        <h2>
                            <?php echo e(__('Filter by')); ?>

                        </h2>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button aria-controls="flush-collapseOne" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseOne" data-bs-toggle="collapse" type="button">
                                    <?php echo e(__('kind')); ?>

                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingOne" class="accordion-collapse collapse show" id="flush-collapseOne">
                                    <div class="accordion-body">
                                        <?php $kindObj = app('App\Repositories\Front\KindRepository'); ?>
                        <?php
                            $kindResults = $kindObj->listExpectedBabiesWithCount();
                        ?>
                          <?php if( $kindResults['code'] == 200 ): ?>
                              <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterKind " data-belongs_to_attribute="Kind" data-filter_column="kindId" id="kind_<?php echo e($row->id); ?>" name="kind" type="radio" value="<?php echo e($row->id); ?>">
                                                <label class="form-check-label" for="kind_<?php echo e($row->id); ?>">
                                                    <?php echo e($row->title); ?>

                                                    <span>
                                                        ( 
                                  <?php if( isset( $kindResults['noOfExpectedBabiesArray'][ $row->id ] ) ): ?>
                                    <?php echo e($kindResults['noOfExpectedBabiesArray'][ $row->id ]); ?>

                                  <?php else: ?>
                                    0
                                  <?php endif; ?>
                                  )
                                                    </span>
                                                </label>
                                            </input>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button aria-controls="flush-collapseTwo" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseTwo" data-bs-toggle="collapse" type="button">
                                        Coming date
                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingTwo" class="accordion-collapse collapse show" id="flush-collapseTwo">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m1" name="comingmonth" type="radio" value="1">
                                                <label class="form-check-label" for="m1">
                                                    <?php echo e(date('F',strtotime('+1 month'))); ?>

                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m2" name="comingmonth" type="radio" value="2">
                                                <label class="form-check-label" for="m2">
                                                    <?php echo e(date('F',strtotime("+2 month"))); ?>

                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m3" name="comingmonth" type="radio" value="3">
                                                <label class="form-check-label" for="m3">
                                                    <?php echo e(date('F',strtotime("+3 month"))); ?>

                                                </label>
                                            </input>
                                        </div>
                                        <div class="row g-0 range">
                                            <div class="col">
                                                <input class="form-control dateCol" id="minrangetext" placeholder="€" type="date">
                                                </input>
                                            </div>
                                            <div class="col-12 text-center dateCol">
                                                To
                                            </div>
                                        </div>
                                        <div class="row g-0 range">
                                            <div class="col">
                                                <input class="form-control dateCol" id="maxrangetext" placeholder="€" type="date">
                                                </input>
                                            </div>
                                            <div class="col">
                                                <button id="customDate">
                                                    <i class="bi bi-chevron-right">
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button aria-controls="flush-collapseThree" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseThree" data-bs-toggle="collapse" type="button">
                                    <?php echo e(__('Race')); ?>

                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingThree" class="accordion-collapse collapse show" id="flush-collapseThree">
                                    <div class="accordion-body">
                                        <?php $raceObj = app('App\Repositories\Front\RaceRepository'); ?>
                        <?php
                            $raceResults = $raceObj->listExpectedBabiesWithCount();
                        ?>
                          <?php if( $raceResults['code'] == 200 ): ?>
                              <?php $__currentLoopData = $raceResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterRace" data-belongs_to_attribute="Race" data-filter_column="raceId" id="race_<?php echo e($row->id); ?>" name="race[]" type="checkbox" value="<?php echo e($row->id); ?>">
                                                <label class="form-check-label" for="race_<?php echo e($row->id); ?>">
                                                    <?php echo e($row->title); ?>

                                                    <span>
                                                        ( 
                                  <?php if( isset( $raceResults['noOfExpectedBabiesArray'][ $row->id ] ) ): ?>
                                    <?php echo e($raceResults['noOfExpectedBabiesArray'][ $row->id ]); ?>

                                  <?php else: ?>
                                    0
                                  <?php endif; ?>
                                  )
                                                    </span>
                                                </label>
                                            </input>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button aria-controls="flush-collapseFour" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseFour" data-bs-toggle="collapse" type="button">
                                        Subscription
                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingFour" class="accordion-collapse collapse show" id="flush-collapseFour">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input filter filterSubscription" data-belongs_to_attribute="Subscription" id="sub" type="checkbox" value="sub">
                                                <label class="form-check-label" for="sub">
                                                    Subscribed
                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterSubscription" data-belongs_to_attribute="Subscription" id="unsub" type="checkbox" value="unsub">
                                                <label class="form-check-label" for="unsub">
                                                    Un-Subscribed
                                                </label>
                                            </input>
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
    <!--  Mobile popup ends here -->
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/eblistfilters.js')); ?>">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
  adListSearchFilter().init("<?php echo e(route('search_ebListings')); ?>?query=data&");
});
  $('#filters_menu').on('show.bs.modal', function (e) {
 $('#desktopFilter').remove();
})
    </script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/subscribe.js')); ?>">
    </script>
    <?php $__env->stopSection(); ?>
</link>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/expectedbabies/listeb.blade.php ENDPATH**/ ?>