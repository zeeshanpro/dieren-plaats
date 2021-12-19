<section id="messageRightSection" style="display:contents">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.loader','data' => []]); ?>
<?php $component->withName('loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <div class="col-md-7">
        <div class="message_window mb-3">
            <div class="window_header pb-3">
                <div class="thumb">
                    <?php if($otherPerson->Breeder->logo): ?>
                    <img alt="No Image" src="<?php echo e(url('/storage/app/public/uploads/users/thumb/'.$otherPerson->Breeder->logo)); ?>" style="border-radius:50%;height:60px">
                    </img>
                    <?php else: ?>
                    <img src="<?php echo e(url('public/front_assets/images/default.jpg')); ?>" style="border-radius:50%;height:60px">
                    </img>
                    <?php endif; ?>
                </div>
                <div class="details">
                    <div class="row g-0">
                        <div class="col">
                            <strong>
                                <?php echo e($otherPerson->Breeder->company_name??$otherPerson->Breeder->owner_name); ?>

                            </strong>
                        </div>
                        <div class="col-4 text-end">
                            <div class="actions">
                                <a href="#">
                                    <i class="bi bi-slash-circle">
                                    </i>
                                </a>
                                <a href="#">
                                    <i class="bi bi-trash-fill">
                                    </i>
                                </a>
                                <a href="#">
                                    <i class="bi bi-archive-fill">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col desc">
                            <span class="date">
                                <?php echo e(__('Member since')); ?>: <?php echo e($otherPerson->Breeder->created_at->format('d/m/Y')); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!--  <a class="text-grey ms-2" href="#">
                                <small>
                                    Review the seller
                                </small>
                            </a> -->
            <div class="text-center text-grey">
                <!--  Today - 9:00 AM -->
            </div>
            <div class="screen" id="screenMsg">
                <span class="text-grey ms-2">
                    <small>
                        Ad
                    </small>
                </span>
                <div class="order">
                    <?php if(isset($adDetail['adImages'][0]->filename) and $adDetail['adImages'][0]->filename): ?>
                    <img src="<?php echo e(url('storage/app/public/uploads/ads/thumb/'.$adDetail['adImages'][0]->filename)); ?>">
                        <?php else: ?>
                        <img src="<?php echo e(url('public/front_assets/images/default.jpg')); ?>">
                            <?php endif; ?>
                            <div class="desc">
                                <span class="date">
                                    <?php echo e($adDetail->created_at->format('M d, Y')); ?>

                                </span>
                                <h6>
                                    <?php echo e($adDetail->title??''); ?>

                                </h6>
                                <div class="price">
                                    €<?php echo e($adDetail->amount??''); ?>

                                </div>
                            </div>
                        </img>
                    </img>
                </div>
                <script>
                    var lastMsgId = 0;
                    var usertype = "<?php echo $usertype; ?>";
                </script>
                <?php if( isset( $oldMsgs ) and $MsgCount > 0 ): ?>
                <?php 
                    $result = $oldMsgs;
                ?>
                <?php endif; ?>

                <?php $__empty_1 = true; $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <script>
                    lastMsgId = <?php echo e($msgRow->id); ?>;
                </script>
                <?php
                                    if(($usertype=="Seller" and $msgRow->ifsent==0)
                                    or ($usertype=="Buyer" and $msgRow->ifsent==1))
                                    {

                                      $positionClass="received"; //here received is actually sent only css class is acting reverse
                                    }
                                    else
                                    {
                                        $positionClass="sent";  //here sent is actually received only css class is acting reverse
                                    }
                                    ?>
                <div class="<?php echo e($positionClass); ?>">
                    <div class="text">
                        <?php echo e($msgRow->msg); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php if(!isset($adId)): ?>
                <h3 class="rounded w-75 border">
                    No <?php echo e(__('Messages')); ?>

                </h3>
                <?php endif; ?>
                <?php endif; ?>

                <script>
                    var element = document.getElementById("<?php echo e($adId); ?>_<?php echo e($user_id); ?>"); 
                                    element.setAttribute("data-lastmsgid", lastMsgId);
                </script>

                <input id="base_container" type="hidden" value="<?php echo e($adId); ?>_<?php echo e($user_id); ?>"/> 
                <!-- 
                                  <div class="sent1 mx-3">
                                    <div id="wave1">
                                        <span class="dot">
                                        </span>
                                        <span class="dot">
                                        </span>
                                        <span class="dot">
                                        </span>
                                    </div>
                                </div> -->
            </div>
            <div class="reply">
                <div class="row g-0">
                    <div class="col-11">
                        <textarea class="form-control" id="msgInputArea"></textarea>
                    </div>
                    <div class="col-1 text-end">
                        <button data-adid="<?php echo e($adId??'0'); ?>" data-lastmsgid="<?php echo e($lastMsgId??'0'); ?>" id="sendMessage">
                            <img src="<?php echo e(asset('front_assets/images/reply-btn.gif')); ?>"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var elementBtn = document.getElementById("sendMessage"); 
            elementBtn.setAttribute("data-lastmsgid", lastMsgId);
    </script> 
</section>
<?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/components/messageList.blade.php ENDPATH**/ ?>