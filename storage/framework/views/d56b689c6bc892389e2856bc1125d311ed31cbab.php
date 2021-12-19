<div class="breeders_panel">
    <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5">
              <h2><?php echo e(__('Breeders')); ?></h2>
          </div>
        </div>
        <div class="row justify-content-center">
            <?php $breederObj = app('App\Repositories\Front\UserRepository'); ?>
            <?php
                $breederRows = $breederObj->getBreeders( 4 );
            ?>
                <?php if( $breederRows['code'] == 200 ): ?>
                    <?php $__currentLoopData = $breederRows['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make( 'front.layout.components.subviews.breederCell', [ 'row' => $row ] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
        </div>
    </div>
  </div> <?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/breeders.blade.php ENDPATH**/ ?>