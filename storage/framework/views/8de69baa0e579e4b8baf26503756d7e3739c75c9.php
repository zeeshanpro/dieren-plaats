 <tbody>
                    <?php if($result->count()<1): ?>
           <tr>
             <td colspan="8">

           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           <?php endif; ?>
           <?php //print_r($result); ?>
                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                      <td><a href="<?php echo e(url('/admin/adsdetail/'.$row->id)); ?>" ><?php echo e($row->id); ?></a></td>
                      <td title="<?php if( $row->status == 0 ) echo 'Paused Ad';?>">
                        <?php if($row->adImages->count()): ?>
                        <a href="<?php echo e(url('/admin/adsdetail/'.$row->id)); ?>" ><img src="<?php echo e(url('storage/app/public/uploads/ads/thumb/'.$row->adImages[0]->filename)); ?>" class="imageStyle <?php if( $row->status == 0 ) echo 'border border-danger'?>" alt="None" style="width: 50px;height:50px;">
                        </a>
                        <?php else: ?>
                        No Image
                        <?php endif; ?>
                      </td>
                      <td>
                        <a class="btn btn-app" href="<?php echo e(url('/admin/adsdetail/'.$row->id)); ?>">
                             <!-- <span class="badge bg-purple">Paid</span> -->
                           <?php echo e($row->title); ?>

                        </a>
                      </td>
                        <td>
                        <?php echo e($row->amount); ?>

                      </td>
                      <td class=" text-center"> <?php echo e($row->adKind->title); ?> </td>
                      <td><?php echo e($row->adRace->title); ?></td>
                      <td>
                        <!-- <img src="https://images-platform.99static.com/Zu1w4iNqj1REDpN60JWbG-wWEZM=/200x100:1000x900/500x500/top/smart/99designs-contests-attachments/66/66198/attachment_66198853" class="rounded" alt="User Image" style="width: 50px;height:50px;"> --><?php echo e($row->adUser->name); ?>

                      </td>
                    <td><?php echo e($row->adUser->usertype); ?></td>
                    <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-danger deletead" data-aid="<?php echo e($row->id); ?>">
                          <i class="fas fa-times"></i>
                        </button>
                        
                      </div>
                       </td>
                    </tr>

                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                  <tr>
             <td colspan="8">
            <!-- /.card-body -->
               <div class="card-footer">
                <?php if($result instanceof \Illuminate\Pagination\LengthAwarePaginator ): ?>
                    <?php echo $result->links('pagination::bootstrap-4'); ?>      
               <?php endif; ?>
            </div>
       <!-- /.card-footer-->
           </td></tr>
               
              </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/ads/ads/table_data.blade.php ENDPATH**/ ?>