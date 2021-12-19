 <tbody>
                    <?php if($result->count()<1): ?>
           <tr>

             <td colspan="6">
           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           <?php endif; ?>
           <?php  $substatus="-"; ?>
                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if( $row->usertype!="Normal" && $row->latestRenewal): ?>
                    <?php if(strtotime(date('Y-m-d')) <= strtotime($row->latestRenewal->renewal_date)): ?>
                        <?php
                        $substatus="Active";
                        ?>
                    <?php endif; ?>
                    <?php else: ?>
                    <?php if( $row->usertype=="Normal" ): ?>
                    <?php
                     $substatus="-";
                    ?>
                    <?php else: ?>
                    <?php
                    $substatus="In-Active";
                    ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <td colspan="7">

            
        </td>
                    </tr>
                    <tr>
                      <td><a href="/admin/view_user/<?php echo e($row->id); ?>"><?php echo e($row->id); ?></a> </td>
                      <td><a href="/admin/view_user/<?php echo e($row->id); ?>"><?php echo e($row->name??'No Name'); ?></a> </td>
                      <td class=" text-center"><?php echo e($row->usertype); ?> </td>
                      <td>
                        <?php if($substatus!="-"): ?>
                        <span class="badge bg-<?php echo e($substatus=="Active"?'success':'danger'); ?>"><?php echo e($substatus); ?></span>
                        <?php else: ?>
                        <?php echo e($substatus); ?>

                        <?php endif; ?>
                    </td>
                      <td><?php echo e($row->user_ads_count); ?></td>
                    <td><?php echo e($row->user_expected_babies_count); ?></td>
                      <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-danger deleteuser" data-uid="<?php echo e($row->id); ?>">
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
               
              </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/user/table_data.blade.php ENDPATH**/ ?>