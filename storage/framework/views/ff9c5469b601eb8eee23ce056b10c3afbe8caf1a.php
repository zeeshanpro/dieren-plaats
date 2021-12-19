 <tbody>
                    <?php if($result->count()<1): ?>
        <tr>
             <td colspan="8">

           <h2 class="text-success text-center">No Record Available</h2>
           </td>
       </tr>
           <?php endif; ?>
           <?php //print_r($result); ?>
                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                       <tr>
                      <td><a href="<?php echo e(url('/admin/expectedad_detail/'.$row->id)); ?>" ><?php echo e($row->id); ?></a></td>
                      <td>
                        <?php echo e($row->expected_babieUser->name); ?>

                        
                      </td> 
                      <td>
                        <a href="<?php echo e(url('/admin/expectedad_detail/'.$row->id)); ?>" >
                        <div class="containerImage mr-1">
                         <img src="<?php echo e(url('storage/app/public/uploads/expectedbabies/thumb/'.$row->father_pic)); ?>" class="image" alt="no image">
                         <span class="overlayImage">
                             <?php echo e($row->father); ?>

                         </span>   
                        </div>
                         <div class="containerImage">
                         <img src="<?php echo e(url('storage/app/public/uploads/expectedbabies/thumb/'.$row->mother_pic)); ?>" class="image" alt="no image">
                         <span class="overlayImage">
                            <?php echo e($row->mother); ?>

                         </span>   
                        </div>
                        </a>
                      </td>

                      <td class=" text-center">  <?php echo e($row->expected_babieKind->title); ?> </td>
                      <td><?php echo e($row->expected_at); ?></td>
  
                    <td>4</td>
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
               
              </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/ads/expectedAds/table_data.blade.php ENDPATH**/ ?>