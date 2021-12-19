 <tbody>
                  <?php if($result->count()<1): ?>
           <tr>
             <td colspan="4">

           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           <?php endif; ?>
                   <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php $__currentLoopData = $row->kindAdAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                      <td><?php echo e($attributes->id); ?></td>
                      <td>
                        <?php echo e($row->title); ?>

                      </td>
                      <td>
                        <div class="input-group input-group-sm" >
                          <input type="text" class="form-control text-info" value="<?php echo e($attributes->title); ?>" id="attributeTitleValue-<?php echo e($attributes->id); ?>">
                          <div class="input-group-append">
                            <button class="btn btn-outline-info btn-block"><i class="fas fa-edit  fa-lg editAttribute" data-attributeid="<?php echo e($attributes->id); ?>" ></i></button>
                          </div>
                          <div class="input-group-append">
                            <button class="btn btn-outline-danger btn-block "><i class="fas fa-times  fa-lg deleteAttribute" data-attributeid="<?php echo e($attributes->id); ?>"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="row justify-content-start">
                    
                          <?php $__currentLoopData = $attributes->ad_attributeAdAttributeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="col-4 mb-2">
                          <div class="input-group input-group-sm" >
                            <input type="text" class="form-control" value="<?php echo e($options->title); ?>" id="optionTitleValue-<?php echo e($options->id); ?>">
                            <div class="input-group-append updateAttributeOptions" data-attributeid="<?php echo e($attributes->id); ?>" data-optionid="<?php echo e($options->id); ?>" >
                              <button class="btn btn-outline-info btn-block"><i class="fas fa-pen-square fa-lg"   ></i></button>
                            </div>
                            <div class="input-group-append deleteAttributeOptions"  data-attributeid="<?php echo e($attributes->id); ?>" data-optionid="<?php echo e($options->id); ?>" >
                                <button class="btn btn-outline-danger btn-block"><i class="fas fa-times  fa-lg " ></i></button>
                            </div>
                        </div>
                      
                      </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                
                    </div><!-- End row -->

              </td>
                <td style="vertical-align: middle;text-align: center;">
                  <div class="row">
                    
                  
                   <div class="col-12 mb-2">
                  <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-add-option" data-attributeid="<?php echo e($attributes->id); ?>" data-attributetitle="<?php echo e($attributes->title); ?>">
                  + Add New
                </button>
                </div>
                  </div>
                  <!-- end row -->
                </td>
                    </tr> 

                          
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
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
                   
                  </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/settings/attributes_table_data.blade.php ENDPATH**/ ?>