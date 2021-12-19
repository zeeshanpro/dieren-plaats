 <tbody>
                  <?php if($result->count()<1): ?>
           <tr>
             <td colspan="4">

           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           <?php endif; ?>
                   <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($row->id); ?></td>
                      <td>
                        <?php echo e($row->title); ?>

                      </td>
                      <td>
                        <?php echo e($row->kind->title); ?>

                      </td>
                      <td>
                   <?php echo e($row->race_ads_count); ?>

                      </td>
                       <td>
                         <?php echo e($row->race_expected_babies_count); ?>

                       </td>
                       <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-edit-race" data-raceid="<?php echo e($row->id); ?>" data-racetitle="<?php echo e($row->title); ?>" data-kindid="<?php echo e($row->kind->id); ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger deleteRace" data-raceid="<?php echo e($row->id); ?>">
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
                   
                   
                  </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/settings/race_table_data.blade.php ENDPATH**/ ?>