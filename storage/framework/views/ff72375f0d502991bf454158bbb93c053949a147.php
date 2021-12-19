 <?php $menudetail = app('App\Repositories\Front\KindRepository'); ?>
 <?php
		$menudata = $menudetail->getAllKindsAndRaces();
 ?>
 <nav class="navbar navbar-expand-lg navbar-light">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle mega_open" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Soort huisdier
			</a>	
				<div class="dropdown-menu dropdown-menuleft mega_menu mega-14 shadow" aria-labelledby="navbarDropdown">
					<div class="row fashion-row">
						<div class="col-12">
							<ul class="list-unstyled fashion-list">
							<?php $__empty_1 = true; $__currentLoopData = $menudata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allKinds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<li class="fashion-menu-item">
									<a href="<?php echo e(route( 'listads_byslug', [ 'kindSlug' => $allKinds->title_slug ] )); ?>" class="fashion-menu-link <?php echo e($loop->first ? 'active show' : ''); ?>"><?php echo e($allKinds->title); ?></a>
									<div class="fashion-menu-item-row <?php echo e($loop->first ? 'active show' : ''); ?>">
										<div class="row py-2">
										<?php $innerCounter = -1; ?>
												<?php $__empty_2 = true; $__currentLoopData = $allKinds->races; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allRaces): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
 													<?php if( $innerCounter == -1 ){ ?>
															<div class="col-lg-3 col-md-3 col-sm-6 border-right">
																<ul class="list-unstyled">
													 <?php } else if( ($innerCounter + 1) % 6 == 0 ) { ?>
																</ul>
															</div>
															<?php 
													 if( ($innerCounter + 1) % (6 * 4) == 0 ) { ?>
															<div class="col-12">
																<div class="dropdown-divider"></div>
													 		</div>
													 <?php } ?>
															<div class="col-lg-3 col-md-3 col-sm-6 border-right">
																<ul class="list-unstyled">
													<?php } ?>
							<li><a href="<?php echo e(route( 'listads_kind_race_slug', [ 'kindSlug' => $allKinds->title_slug , 'raceSlug' => $allRaces->title_slug ] )); ?>" class="fashion-menu-item-row-black">
								<div style="display: block;height: 30px;float: left;">
								<i class="fas fa-paw" style="color:#F72442;padding-right: 5px;"></i></div> <?php echo e($allRaces->title); ?> 
										</a></li>
													<?php $innerCounter++; ?>	
													
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
														
												<?php endif; ?>
											<?php if( ($innerCounter + 1) % 6 == 0 ) {  ?>
													</ul>
														 </div>
												<?php } ?>
											</div>	
										</div>		
							</li>			
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
								
							<?php endif; ?>	
								
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
		</div>
	</div>
                          </nav><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/megamenu.blade.php ENDPATH**/ ?>