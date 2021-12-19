<div class="highlighted_panel">
    <div class="container">
        <div class="row ">
          <div class="col-md-12 text-center mb-5">
              <h2><?php echo e(__('Highlighted')); ?></h2>
          </div>
        </div>
        <div class="row justify-content-center">
            <?php $adMaster = app('App\Repositories\Front\AdRepository'); ?>
            <?php
                $adResults = $adMaster->listAds( 8 );
            ?>
                <?php if( $adResults['code'] == 200 ): ?>
                <?php 
                if( isset( $adResults['savedAdsIds'] ) )
                    $adids = explode(',', $adResults['savedAdsIds']);
                else
                    $adids = array();
                    ?>
                    <?php $__currentLoopData = $adResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                    $idExist = in_array($row->id , $adids); 
                    ?>
                        <?php echo $__env->make( 'front.layout.components.subviews.adCell', [ 'topAdsArray' => $adResults['topAdsArray'], 'row' => $row , 'ifWatchLater'=>$idExist] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
        </div>
    </div>
  </div> <?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/adlisting.blade.php ENDPATH**/ ?>