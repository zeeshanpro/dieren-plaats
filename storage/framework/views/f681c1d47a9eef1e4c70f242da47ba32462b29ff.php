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
                      <td><a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-xl-details" data-uname="<?php echo e($row->user->name); ?>" 
                        data-stripe_id="<?php echo e($row->user->stripe_id); ?>" data-payment_intent="<?php echo e($row->paymentDetails->payment_intent); ?>" data-payment_method="<?php echo e($row->paymentDetails->payment_method); ?>" data-payment_method_type="<?php echo e($row->paymentDetails->payment_method_type); ?>" data-fingerprint="<?php echo e($row->paymentDetails->fingerprint); ?>" data-mandate="<?php echo e($row->paymentDetails->mandate); ?>" data-subscription="<?php echo e($row->paymentDetails->subscription); ?>" data-subscription_item="<?php echo e($row->paymentDetails->subscription_item); ?>" 
                        ><?php echo e($row->id); ?></a> </td>
                      <td class="text-center"><a href="/admin/view_user/<?php echo e($row->user->id); ?>"><?php echo e($row->user->name); ?></a><a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-xl-details" data-uname="<?php echo e($row->user->name); ?>" 
                        data-stripe_id="<?php echo e($row->paymentDetails->stripe_id); ?>" data-payment_intent="<?php echo e($row->paymentDetails->payment_intent); ?>" data-payment_method="<?php echo e($row->paymentDetails->payment_method); ?>" data-payment_method_type="<?php echo e($row->paymentDetails->payment_method_type); ?>" data-fingerprint="<?php echo e($row->paymentDetails->fingerprint); ?>" data-mandate="<?php echo e($row->paymentDetails->mandate); ?>" data-subscription="<?php echo e($row->paymentDetails->subscription); ?>" data-subscription_item="<?php echo e($row->paymentDetails->subscription_item); ?>" 
                        >
                        <small class="d-block text-primary">( <?php echo e($row->user->stripe_id); ?> )</small>
                      </a>
                      </td>
                      <td class=" text-center"><?php echo e($row->user->usertype); ?> </td>
                      <td><small><?php echo e($row->user->stripe_product_id??'No Id'); ?></small></td>
                      <td><?php echo e($row->paymentDetails->payment_method_type); ?></td>
                    <td><?php echo e($row->date_of_transaction); ?></td>
                    <td><?php echo e($row->renewal_date); ?></td>
                    <td>
                        <div class="btn-group">
                        <a href="<?php echo e($row->paymentDetails->hosted_invoice_url??'#'); ?>" class="btn btn-success" target="_blank">
                          <i class="fas fa-file-pdf"></i>
                        </a>
                        

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
               
              </tbody><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/subscription/table_data.blade.php ENDPATH**/ ?>