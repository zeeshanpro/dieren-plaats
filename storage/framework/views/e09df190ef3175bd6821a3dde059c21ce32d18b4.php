<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-2 left_sidebar">
                    <?php echo $__env->make('front.userpanel.sideMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">

                  <?php $__currentLoopData = $savedAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                        <?php echo $__env->make( 'front.layout.components.subviews.adCell', [ 'row' => $row , 'ifWatchLater'=>true,'cellColumn'=>4] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                 
              </div>
                <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                          </li>
                          <li class="page-item active"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                            </a>
                          </li>
                        </ul>
                      </nav>
                  </div>
                  <div class="col-auto">
                    <div class="page_per">
                      <select class="form-select" aria-label="Default select example">
                        <option selected>9</option>
                        <option value="1">15</option>
                        <option value="2">20</option>
                        <option value="3">30</option>
                      </select>
                      <label>Item per page</label>
                    </div>
                  </div>
              </div>
              </div>
          </div>
      </div>
  </div> 
   <?php $__env->stopSection(); ?>
    <?php $__env->startSection('optional_scripts'); ?>
      <script type="text/javascript">
        var APP_URL="<?php echo e(url('/')); ?>";
      </script>
<script src="<?php echo e(asset( $publicPath . 'front_assets/js/adsaveforlater.js')); ?>"></script>
      <?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/savedAds.blade.php ENDPATH**/ ?>