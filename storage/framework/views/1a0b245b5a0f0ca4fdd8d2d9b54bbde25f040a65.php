<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('container'); ?>

<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col">
                  <h3><?php echo e(__('Add new ad')); ?></h3>
              </div>
          </div>
          <?php if( $OkToProceed == false ): ?>
          <p class="alert alert-info"><?php echo e($msg); ?></p>
          <?php endif; ?>
          
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2><?php echo e(__('Select animal kind')); ?></h2>
                                </div>
                                <div class="col text-end text-grey">
                                <?php echo e(__('Step')); ?>: 1/4
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                                 <!-- SELECT ANIMAL KIND -->
                                 <div class="select_animal_kind">
                                    <div class="row">
                                 <?php $kindMaster = app('App\Repositories\Front\KindRepository'); ?>
                                <?php
                                    $kindResults = $kindMaster->list( 30 );
                                ?>
                                <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-3 col-6">
                                            <a href="javascript:void(0);" onclick="return onKindSelection('<?php echo e($row->id); ?>');">
                                            <figure class="figure" id="figure_<?php echo e($row->id); ?>">
                                              <img src="<?php echo e(url('storage/app/public/uploads/kind/thumb/'.($row->image ?? 'default.png'))); ?>" class="figure-img img-fluid rounded" alt="...">
                                              <figcaption class="figure-caption" ><?php echo e($row->title); ?></figcaption>
                                            </figure></a>
                                          </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                 </div>  
                                 <!-- / SELECT ANIMAL KIND -->
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
                
              </div>

              <div class="col-lg-3 col-md-4 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info d-none d-md-block py-5">
                      <div class="row">
                        <div class="col">
                            <div class="button_block">
                            <?php if( $OkToProceed == false ): ?>
                              <span style="color:red;"><?php echo e($msg); ?></span>
                            <?php endif; ?>
                                <div class="d-grid gap-2">  
                                  <a href="#" id="goto_createad_fillform" class="btn btn-primary btn-lg"><?php echo e(__('Continue')); ?></a>
                                  <a href="<?php echo e(url('/')); ?>" class="btn btn-info btn-lg"><?php echo e(__('Back')); ?></a>
                                </div>
                            </div>
                      </div>
                  </div> 
                </div>
                <div class="info d-block d-md-none position-fixed bottom-0 end-0 bg-white w-100 py-4 shadow" style="z-index:999;">
                      <div class="row">
                        <div class="col-6">
                            <div class="button_block">
                            <?php if( $OkToProceed == false ): ?>
                              <span style="color:red;"><?php echo e($msg); ?></span>
                            <?php endif; ?>
                                <div class="d-grid gap-2">  
                                  <a href="#" id="goto_createad_fillform_btn" class="btn btn-primary "><?php echo e(__('Continue')); ?></a>
                                  <!-- <a href="#" class="btn btn-lg">Save as Draft</a> -->
                                </div>
                            </div>
                      </div>
                      <div class="col-6">
                            <div class="button_block">
                                <div class="d-grid gap-2">  
                                  <a href="<?php echo e(url('/')); ?>" class="btn btn-info "><?php echo e(__('Back')); ?></a>
                                  <!-- <a href="#" class="btn btn-lg">Save as Draft</a> -->
                                </div>
                            </div>
                      </div>
                  </div>  
                  <!-- ending info here above -->
              </div>
              
          </div>
      </div>
  </div> 
<script>
  <?php if( $OkToProceed == true ): ?>
    function onKindSelection( kind ){
        $('.figure').each( function() {
          $(this).css( 'border-width', '0' );
        } );
        var link = document.getElementById("goto_createad_fillform");
        link.setAttribute('href', kind + "/filldetails");

        var link_btn = document.getElementById("goto_createad_fillform_btn");
        link_btn.setAttribute('href', kind + "/filldetails");
        $("#figure_" + kind).css( 'border', '3px solid red' );
    }

    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/ad/createad_showkinds.blade.php ENDPATH**/ ?>