<section style="display:contents;" id="breederDataContainer">
<div class="col-md-9 mt-3" >
                <div class="row">
                 
                <?php if( $code == 200 ): ?>
                    <?php $__empty_1 = true; $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php echo $__env->make( 'front.layout.components.subviews.breederCell', [ 'row' => $row , 'wideStyle' => true ] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <h3 class="border rounded p-4 w-75 m-2">No Breeder Available In This Search.</h3>
                    <?php endif; ?>
                <?php endif; ?>
                
                </div>
            </div>
            <div class="col-md-1 pt-5">
                  <img src="<?php echo e(asset('front_assets/images/advertisement.svg')); ?>" />
              </div>
              </div> <!-- end of row in inner_page_content_area -->
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                  <?php echo e($result->links('pagination::bootstrap-4')); ?>


                     
                  </div>
                
              </div>
</section><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/breederListBridge.blade.php ENDPATH**/ ?>