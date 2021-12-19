 <tbody>
                  <?php if($result->count()<1): ?>
           <tr>
             <td colspan="3">

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
                   <?php echo e($row->kind_ads_count); ?>

                      </td>
                       

                        <td>
                          <?php echo e($row->kind_breeder_kinds_count); ?>

                        </td>
                        <td>
                          <?php echo e($row->kind_expected_babies_count); ?>

                        </td>
                           <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-edit-kind" data-kindid="<?php echo e($row->id); ?>" data-kindtitle="<?php echo e($row->title); ?>" data-currimage="<?php echo e($row->image); ?>" data-curriconimage="<?php echo e($row->icon); ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger deleteKind" data-kindid="<?php echo e($row->id); ?>">
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
                   
                   
                  </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/settings/kind_table_data.blade.php ENDPATH**/ ?>