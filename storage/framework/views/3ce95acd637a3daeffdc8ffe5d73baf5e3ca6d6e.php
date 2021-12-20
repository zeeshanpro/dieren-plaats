
<?php $__env->startSection('title','Dashboard'); ?>
<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('container'); ?>
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Subscriptions</span>
                <span class="info-box-number">
                <?php echo e($renewalCount); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-ban"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ads</span>
                <span class="info-box-number">
                  <?php echo e($adCount); ?>

                  <small> (Total Listings)</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ads Expected</span>
                 <span class="info-box-number">
                  <?php echo e($expectedBabieCount); ?>

                  <small> Total Listings</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                 <span class="info-box-number">
                  <?php echo e($userCount); ?>

                  <small> Registered</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>  
        <div class="row">
          <div class="col-lg-6">
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Latest 5 Ads</h3>
                <div class="card-tools">
                <!--   <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a> -->
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>

              <!-- Latest 5 Transactions -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Kind</th>
                    <th>Race</th>
                    <th>Title</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                    <td>
                      <?php echo e($ad->adKind->title); ?>

                    </td>
                    <td><?php echo e($ad->adRace->title); ?></td>
                    <td>
                    <?php echo e($ad->title); ?>

                    </td>
                    <td>
                      <a href="<?php echo e(route('admin-adsdetail', ['adId' => $ad->id] )); ?>" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr>
                        <td colspan="4">No information to display</td>
                      </tr>
                    <?php endif; ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- Latest 5 Transactions Ends Here -->


            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
          
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Device Usage</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="235"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-success"></i> IOS</li>
                      <li><i class="far fa-circle text-primary"></i> ANDROID</li>

                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Neaderland
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i>
                        12%</span>
                    </a>
                  </li>
               
                </ul>
              </div>
              <!-- /.footer -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('optional_scripts'); ?>
<script src="<?php echo e(asset( $publicPath . 'admin_assets/plugins/chart.js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset( $publicPath . 'admin_assets/dist/js/pages/deviceusagechart.js')); ?>"></script>
<script src="<?php echo e(asset( $publicPath . 'admin_assets/dist/js/pages/dashboard3.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7.4\htdocs\dieren-plaats\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>