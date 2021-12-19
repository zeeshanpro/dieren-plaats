<?php $__env->startSection('title','Settings'); ?>

<?php $__env->startSection('container'); ?>
<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Change Settings</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <style type="text/css">
          .updateImage
          {
             display: inline;
            position: absolute;
            right: 35%;
            cursor: pointer;
           
          }
.proIage img
          { 
            border: 1px solid lightgray;
          }
        

        </style>
        <div class="card-body">
          <?php if(Session::has('message')): ?>
            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
          <?php endif; ?>
        <div class="row">
          <div class="col-6">
           <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Update Profile</p>

      <form action="/admin/adminsettings" method="post">
      <?php echo csrf_field(); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="name" value="<?php echo e($admin->name); ?>">
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php echo e($admin->Breeder->phone); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo e($admin->email); ?>">
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>
        
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Owner Name" name="owner_name" value="<?php echo e($admin->Breeder->owner_name); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="<?php echo e($admin->Breeder->company_name); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Street" name="street" value="<?php echo e($admin->Breeder->street); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo e($admin->Breeder->city); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Country" name="country" value="<?php echo e($admin->Breeder->country); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Facebook Link" name="fb_url" value="<?php echo e($admin->Breeder->fb_url); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Instagram Link" name="insta_url" value="<?php echo e($admin->Breeder->insta_url); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="LinkedIn Profile" name="linkedin_url" value="<?php echo e($admin->Breeder->linkedin_url); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="">
        <p class="">About Website</p>
        </div>
        <div class="input-group mb-3">
          <textarea class="form-control" name="company_about" cols="20" rows="10"><?php echo e($admin->Breeder->company_about); ?></textarea>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
     
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->    
          </div>



        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('optional_scripts'); ?>
<script>
$('#updateImage').click(function(){ $('#profileImge').trigger('click'); });

$(document).ready(()=>{
      $('#profileImge').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file.type=="image/jpeg" || file.type=="image/png"){

          let reader = new FileReader();
          reader.onload = function(event){
            // console.log(event.target.result);
            $('#img_profile').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        
         //submit form
       $("#imageUploadForm").submit();

        }
      else
      {
         $('<div>Invalid Format</div>').insertAfter('#img_profile').delay(3000).fadeOut();
        console.log("Invalid Format");
      }

     });


//Ajax Upload Pic

      $('#imageUploadForm').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    $('<div>'+data.success+'</div>').insertAfter('#img_profile').delay(13000).fadeOut();
                },
                error: function(response){
                  $('<div>'+response.responseJSON.message+'</div>').insertAfter('#img_profile').delay(3000).fadeOut();
                }
            });
      }));

    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/settings.blade.php ENDPATH**/ ?>