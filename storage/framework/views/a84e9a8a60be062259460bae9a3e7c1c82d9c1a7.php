
<div class="<?php echo e(isset($wideStyle) ? 'col-lg-4' : 'col-lg-3'); ?> col-md-5">
                <!-- IMAGE BOX -->
    <div class="image_box type_3 <?php echo e(isset($wideStyle) ? 'mb-4' : ''); ?>">
        <div class="info">
            <div class="row">
                <div class="col col-md-4 left-side">
                   <a href="<?php echo e(url('/profile/'.$row->id.'/'.Str::slug($row->breeder->owner_name))); ?>"> 
                    <?php if(isset($row->breeder->logo) && $row->breeder->logo): ?>
                    <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/' . $row->breeder->logo ?? '')); ?>" alt="No Image" />
                    <?php else: ?>
                    <img src="<?php echo e(asset('front_assets/images/default.jpg')); ?>" alt="No Image" />
                    <?php endif; ?>

                   </a>
                      <ul class="detail_list" style="margin: 12px 22px;">
                        
                        <li><label>Ads</label><?php echo e($row->user_ads_count); ?></li>
                    </ul>
                </div>
                <div class="col-8 col-md-8">
                    <div class="name" title="<?php echo e($row->breeder->company_name ? $row->breeder->company_name : $row->breeder->owner_name??'No Name'); ?>">
                        <a href="<?php echo e(url('/profile/'.$row->id.'/'.Str::slug($row->breeder->owner_name))); ?>"> 
                    <?php echo e(Str::ucfirst($row->breeder->company_name ? Str::limit($row->breeder->company_name, 10, '...') : Str::limit($row->breeder->owner_name, 10, '...')??'No Name')); ?>

                </a>
                    </div>
                    <div class="reviews">
                    <?php echo $__env->make( 'front.layout.components.stars',['stars'=> ($row->breeder->avgRating[0]->aggregate ?? '0') ] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <ul class="detail_list">
                        <li><label>Type</label> <?php echo e($row->breeder->breederKinds[0]->breeder_kindKind->title ?? 'niet vermeld'); ?></li>
                        <li><label>Breed</label><?php echo e($row->breeder->breederKinds[0]->breeder_kindRace->title ?? 'niet vermeld'); ?>

                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>  
    </div>
</div><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/subviews/breederCell.blade.php ENDPATH**/ ?>