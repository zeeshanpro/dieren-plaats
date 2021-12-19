 <div class="direct-chat-messages">
                      <!-- Message. Default to the left Buyer -->
                      <?php $__empty_1 = true; $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <?php if($row->ifsent==1): ?>
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left"><?php echo e($row->messageUser->name??'None'); ?></span>
                          <span class="direct-chat-timestamp float-right"><?php echo e($row->created_at->format('d M h:i A')); ?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                         <?php if($row->messageUser->Breeder->logo): ?>
                <img class="direct-chat-img" src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$row->messageUser->Breeder->logo)); ?>" alt="None" style="height:40px;">
                <?php else: ?>
                <img class="direct-chat-img" src="<?php echo e(asset('/admin_assets/dist/img/default-150x150.png')); ?>" alt="<?php echo e($member->name??'None'); ?>" alt="Default Image">
                <?php endif; ?>
                        
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                         <?php echo e($row->msg??'-'); ?>

                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->

                      <?php else: ?>

                      <!-- Message to the right Seller -->
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right"><?php echo e($row->messageAd->adUser->name??'None'); ?></span>
                          <span class="direct-chat-timestamp float-left"><?php echo e($row->created_at->format('d M h:i A')); ?></span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <?php if($row->messageUser->Breeder->logo): ?>
                        <img class="direct-chat-img" src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$row->messageAd->adUser->Breeder->logo)); ?>" alt="None" style="height:40px;">
                        <?php else: ?>
                        <img class="direct-chat-img" src="<?php echo e(asset('/admin_assets/dist/img/default-150x150.png')); ?>" alt="<?php echo e($member->name??'None'); ?>" alt="Default Image">
                        <?php endif; ?>
                
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                           <?php echo e($row->msg??'-'); ?>

                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
                        <?php endif; ?>
                   


                    </div>
                    <!--/.direct-chat-messages--><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/layouts/component/chatdata.blade.php ENDPATH**/ ?>