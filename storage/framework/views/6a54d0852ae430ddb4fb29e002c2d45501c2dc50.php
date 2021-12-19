<?php $publicPath = env('ASSETS_PATH'); ?>
<div class="<?php echo e(isset($cellColumn) ? 'col-11 ':'col-12 '); ?> col-md-5 col-lg-<?php echo e($cellColumn ?? '3'); ?> mb-md-3 p-0 px-md-2">
                <!-- IMAGE BOX -->
                <div class="image_box" style=" min-height: 440px;">
                     <div class="row p-0">
        <div class="col-5 col-md-12 align-self-center ">
                    <a href="<?php echo e(url('ad/'.$row->adKind->title_slug.'/'.$row->title_slug)); ?>"><?php if(isset( $row->adImages )): ?>
                    <?php if( count( $row->adImages ) > 0 and file_exists( 'storage/app/public/uploads/ads/thumb/'.$row->adImages[0]->filename ) ) {?>
                        <img src="<?php echo e(url('storage/app/public/uploads/ads/thumb/'. $row->adImages[0]->filename)); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset( 'front_assets/images/noimage.jpg' )); ?>';" >
                    <?php } else { ?>
                        <img src="<?php echo e(asset( 'front_assets/images/noimage.jpg' )); ?>" >
                    <?php } ?>    
                        <?php endif; ?>
                    </a>
                    <?php if( isset( $topAdsArray ) and in_array(  $row->id , $topAdsArray ) ) {?>
                                        <span class="top_ad">Top Ad</span><?php } ?>
                    <?php 
                    if( isset( $row->adUser->usertype ) and $row->adUser->usertype != 'Normal' )
                    { ?>
                        <span class="bottom_ad_breeder"><?php echo e($row->adUser->usertype); ?></span>
                        <?php 
                    }
                        ?>


       </div>

       <div class="col-7 col-md-12 px-0 px-md-2">
                    <div class="info">
                       
                       
                        <?php if(request()->routeIs('showMyAds')): ?>
                        <span class="place_on_img"> 

                            <label class="switch">
                              <input type="checkbox" <?php echo e($row->status?'checked':''); ?> class="isAdPublished" data-id="<?php echo e($row->id); ?>">
                              <span class="slider round"></span>
                            </label>
                        </span>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-8 col-md-8">
                                <div class="date">
                                <?php echo  date('M d, Y', strtotime( $row->created_at ) ); ?> 
                                </div>
                                <div class="name">
                            <a title="<?php echo e($row->title); ?>" href="<?php echo e(url('ad/'.$row->adKind->title_slug.'/'.$row->title_slug)); ?>"><?php echo e(Str::limit($row->title,35) ?? ''); ?></a>
                                </div>
                                <div class="price">
                                    <a href="<?php echo e(url('ad/'.$row->adKind->title_slug.'/'.$row->title_slug)); ?>">€ <?php echo e($row->amount  ?? '-'); ?></a>
                                </div>
                            </div>
                            
                            <div class="col-4 col-md-4 text-start text-md-end">
                                <?php if( isset( $myad ) and $myad == 1): ?>
                                 <a href="<?php echo e(route('showAdUpdateForm', ['adId'=>$row->id])); ?>">
                                    <i class="bi bi-pencil-square mx-1"> </i>
                                </a>
                                <?php endif; ?>
                              <a href="javascript:void(0);" class="save_me act_saveme <?php echo e(($ifWatchLater?'active': '')); ?>" data-id="<?php echo e($row->id); ?>"><i class="bi bi-heart"></i><i class="bi bi-heart-fill"></i></a>
                                <div class="views">
                                    <img src="<?php echo e(asset( $publicPath . 'front_assets/images/show-icon.svg')); ?>" > <?php echo e($row->ad_views_count  ?? '0'); ?>

                                </div>
                            </div>
                            <div class="col col-md-12">
                            <?php
                                $counter = 0;
                            ?>
                            <?php $__currentLoopData = $row->adSelectedAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeAndOptions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="feature_list">
                                        <img src="<?php echo e(asset( $publicPath . 'front_assets/images/paw-red.svg')); ?>" />
                                        <?php
                                            if( isset( $row->adSelectedAttributes ) ){ ?>
                                                <?php echo e($row->adSelectedAttributes[$counter]->ad_selected_attributeAd_attribute_option->ad_attribute_optionAd_attribute->title); ?> :
                                        <?php echo e($row->adSelectedAttributes[$counter]->ad_selected_attributeAd_attribute_option->title); ?>

                                        <?php    }
                                        ?> 
                                        </div>
                                        <?php $counter++;  
                                        if( $counter == 2 ){
                                            break;
                                        }
                                        ?>   
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                  
                    </div> 

       </div> 
   </div>
   
                </div>
            </div><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/subviews/adCell.blade.php ENDPATH**/ ?>