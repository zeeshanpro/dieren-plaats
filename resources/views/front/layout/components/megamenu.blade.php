 @inject('menudetail','App\Repositories\Front\KindRepository')
 @php
		$menudata = $menudetail->getAllKindsAndRaces();
 @endphp
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
							@forelse ($menudata as $allKinds)
							<li class="fashion-menu-item">
									<a href="{{route( 'listads_byslug', [ 'kindSlug' => $allKinds->title_slug ] )}}" class="fashion-menu-link {{ $loop->first ? 'active show' : '' }}">{{$allKinds->title}}</a>
									<div class="fashion-menu-item-row {{ $loop->first ? 'active show' : '' }}">
										<div class="row py-2">
										<?php $innerCounter = -1; ?>
												@forelse ( $allKinds->races as $allRaces)
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
							<li><a href="{{route( 'listads_kind_race_slug', [ 'kindSlug' => $allKinds->title_slug , 'raceSlug' => $allRaces->title_slug ] )}}" class="fashion-menu-item-row-black">
								<div style="display: block;height: 30px;float: left;">
								<i class="fas fa-paw" style="color:#F72442;padding-right: 5px;"></i></div> {{$allRaces->title}} 
										</a></li>
													<?php $innerCounter++; ?>	
													
												@empty
														
												@endforelse
											<?php if( ($innerCounter + 1) % 6 == 0 ) {  ?>
													</ul>
														 </div>
												<?php } ?>
											</div>	
										</div>		
							</li>			
							@empty
								
							@endforelse	
								
							</ul>
						</div>
					</div>
				</div>
			</li>
		</ul>
		</div>
	</div>
                          </nav>