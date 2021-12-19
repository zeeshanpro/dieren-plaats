<div class="col-md-5">
    <?php
    $msginfo=array();
    ?>
                        <!-- MESSAGES LIST -->
                        <div class="messages_list">
                          
                        <?php if( isset( $adId ) ): ?>
<!-- MESSAGE -->
                            <div class="message active " id="<?php echo e($adId??'0'); ?>_<?php echo e(Auth::id() ??'0'); ?>" data-adid="<?php echo e($adId??'0'); ?>" data-lastmsgid="<?php if( isset($msgCount) and $msgCount > 0 ): ?> <?php echo e($oldMsgs[ $msgCount - 1 ]->id); ?><?php endif; ?>">
                                <div class="thumb">
                                    
                                    <?php if($otherPerson->Breeder->logo): ?>
                                    <img src="<?php echo e(url('/storage/app/public/uploads/users/thumb/'.$otherPerson->Breeder->logo)); ?>" style="border-radius:50%;height:60px;object-fit: cover;">
                                    </img>
                                    <?php else: ?>
                                <img src="<?php echo e(url('public/front_assets/images/default.jpg')); ?>"  style="border-radius:50%;height:60px">
                                    </img>
                                    <?php endif; ?>
                                    
                                </div>
                                <div class="details">
                                    <div class="row g-0">
                                        <div class="col">
                                            <strong>
                                                
                                            <?php echo e($otherPerson->Breeder->company_name ?? $otherPerson->Breeder->owner_name); ?>

                                            
                                            </strong>
                                        </div>
                                        <div class="col-3 text-end">
                                            <span class="date">
                                                <?php echo e(date('d/m/Y',strtotime($dateOfContact))??''); ?> 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if( isset($msgCount) ): ?>
                                        <div class="col desc">
                                            <?php echo e(Str::limit($oldMsgs[ $msgCount - 1 ]->msg, 25)); ?>

                                        </div>
                                        <div class="col-3 text-end">
                                            <span class="text-info" style="font-size:12px;">
                                            <i class="bi bi-circle-fill"></i>
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                        <?php endif; ?>

                          <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                          if( isset( $adId ) and $row->ad_id==$adId)
                          continue;
                          ?>
                            <!-- MESSAGE -->
                            <div class="message" id="<?php echo e($row->ad_id??'0'); ?>_<?php echo e($row->user_id??'0'); ?>" data-adid="<?php echo e($row->ad_id??'0'); ?>" data-lastmsgid="<?php echo e($row->id); ?>">
                                <div class="thumb">
                                    <?php if( Auth::id() == $row->user_id ): ?>
                                    <?php if($row->messageAd->adUser->Breeder->logo): ?>
                                    <img src="<?php echo e(url('/storage/app/public/uploads/users/thumb/'.$row->messageAd->adUser->Breeder->logo)); ?>" style="border-radius:50%;height:60px;object-fit: cover;">
                                    </img>
                                    <?php else: ?>
                                <img src="<?php echo e(url('public/front_assets/images/default.jpg')); ?>"  style="border-radius:50%;height:60px">
                                    </img>
                                    <?php endif; ?>
                                    <?php else: ?>

                                    <?php if($row->messageUser->Breeder->logo): ?>
                                    <img src="<?php echo e(url('/storage/app/public/uploads/users/thumb/'.$row->messageUser->Breeder->logo)); ?>" style="border-radius:50%;height:60px;object-fit: cover;">
                                    </img>
                                    <?php else: ?>
                                <img src="<?php echo e(url('public/front_assets/images/default.jpg')); ?>"  style="border-radius:50%;height:60px">
                                    </img>
                                    <?php endif; ?>

                                    <?php endif; ?>
                                </div>
                                <div class="details">
                                    <div class="row g-0">
                                        <div class="col">
                                            <strong>
                                                 <?php if( Auth::id() == $row->user_id ): ?>
                                            <?php echo e($row->messageAd->adUser->Breeder->company_name??$row->messageAd->adUser->Breeder->owner_name); ?>

                                            <?php else: ?>
                                            <?php echo e($row->messageUser->Breeder->company_name??$row->messageUser->Breeder->owner_name); ?>


                                            <?php endif; ?>
                                            </strong>
                                        </div>
                                        <div class="col-3 text-end">
                                            <span class="date">
                                                <?php echo e($row->created_at->format('d/m/Y')); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col desc">
                                            <?php echo e(Str::limit($row->msg, 25)); ?>

                                        </div>
                            <?php if( ( (Auth::id() == $row->user_id and  $row->ifsent == 0 ) or 
                            ( in_array($row->ad_id,$myAds) and $row->ifsent == 1 ) ) and 
                            $row->isread == 0): ?>
                                        <div class="col-3 text-end newMsgCircle"  data-gs="<?php echo e($row->ad_id); ?>">
                                            <span class="text-info" style="font-size:12px;">

                                            <i class="bi bi-circle-fill"></i>
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden"  value="0" id="lastmsgid">
                            

                        </div>
                    </div>
<?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/messageListLeft.blade.php ENDPATH**/ ?>