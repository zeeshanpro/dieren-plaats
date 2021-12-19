<section style="display:contents;" id="adDataContainer">
    <div class="row justify-content-center">
            <?php 
            
        if( isset( $savedAdsIds ) )
            $adids = explode(',', $savedAdsIds);
        else
            $adids = array();
            ?>
            
            <?php $__empty_1 = true; $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php 
            $idExist = in_array($row->id , $adids); 
            ?>
                <?php echo $__env->make( 'front.layout.components.subviews.adCell', [ 'topAdsArray' => $topAdsArray, 'row' => $row , 'ifWatchLater'=>$idExist,'cellColumn' => 4] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <h3 class="border rounded m-2 p-4 w-75"><?php echo e(__('No Data Available')); ?></h3>
            <?php endif; ?>


        </div>
        <!-- CONTENT BOTTOM PANEL-->
        <div class="row mt-4 mb-4">
        <div class="col-auto me-auto">
            <?php echo e($result->links('pagination::bootstrap-4')); ?>

        </div>
        </div>
</section><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/adListBridge.blade.php ENDPATH**/ ?>