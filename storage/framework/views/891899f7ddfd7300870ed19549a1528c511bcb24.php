
<?php $kindMaster = app('App\Repositories\Front\KindRepository'); ?>
<?php
    if( isset( $hideViewAll ) )
        $showNos = 50;
    else 
        $showNos = 7;

    $kindResults = $kindMaster->list( $showNos );
?>
  <?php if( $iconstyle ?? false ): ?>
  <div class="search_by_type_panel">
      <div class="container">
          <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h5><?php echo e(__('Type of pets')); ?></h5>
                <h2><?php echo e(__('Search by type')); ?></h2>
            </div>
          </div>
          <div class="row">
                <div class="float_icon" style="margin-left:-58px;"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/dog.svg')); ?>"/></div>
                <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-md-3">
                    <a href="<?php echo e(route( 'listads_byslug', [ 'kindSlug' => $row->title_slug ] )); ?>">
                    <div class="type_box">
                        <img style="width:104;height:104px;" src="<?php echo e(url('storage/app/public/uploads/kindicon/thumb/'.($row->icon ?? 'default.png'))); ?>">
                        <h3><?php echo e($row->title); ?></h3>
                    </div>
                    </a>  
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if( !isset($hideViewAll) ): ?>
              <div class="col-6 col-md-3">
                <a href="#">
                <div class="type_box">
                    <a href="<?php echo e(url('allkinds')); ?>">
                    <img src="<?php echo e(asset( $publicPath . 'front_assets/images/type8.svg')); ?>">
                    <h3><?php echo e(__('View all')); ?></h3>
                    </a>
                </div>
                </a>
                <div class="float_icon" style="right:-70px;"><img src="<?php echo e(asset('/front_assets/images/cat.svg')); ?>"/></div>
              </div>
            <?php endif; ?>

          </div>
      </div>
  </div> 
  <?php elseif(!isset($mobileMenu) && !isset($iconstyle)): ?>
        <div class="middle_bar d-none d-md-block">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <ul>
                        <?php if( $kindResults['code'] == 200 ): ?>
                            <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e(request()->is('adlistings/'.$row->title_slug ) ? 'underline' : ''); ?>"><a href="<?php echo e(route( 'listads_byslug', [ 'kindSlug' => $row->title_slug ] )); ?>"><?php echo e($row->title); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
  <?php endif; ?>

  <?php if( $mobileMenu ?? false ): ?>
 <?php if( $kindResults['code'] == 200 ): ?>
                            <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="nav-link <?php echo e(request()->is('adlistings/'.$row->title_slug ) ? 'active ' : ''); ?>" href="<?php echo e(route( 'listads_byslug', [ 'kindSlug' => $row->title_slug ] )); ?>" <?php echo e(request()->is('adlistings/'.$row->title_slug ) ? 'aria-current="page" ' : ''); ?>><?php echo e($row->title); ?></a>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

  <?php endif; ?>
  
  
  <?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/middlemenu.blade.php ENDPATH**/ ?>