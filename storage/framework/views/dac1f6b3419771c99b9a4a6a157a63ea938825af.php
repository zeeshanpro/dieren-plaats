<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-2 left_sidebar">
                    <?php echo $__env->make('front.userpanel.sideMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-10">
                <div class="row">
                    <form enctype="multipart/form-data" method="post" id="submitdetails" action="editprofile"> <?php echo csrf_field(); ?> 
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2><?php echo e(__('Profile info')); ?></h2>
                                </div>
                                <div class="col text-end">
                                
                                    <h2><input type="submit" name="save" value="Save">
                                    <!-- <a href="" onclick="document.getElementById('submitdetails').submit();"><strong>Save</strong></a> -->
                                  </h2>
                                </div>
                            </div>
                          </div>

                          <div class="col-12">
                          <?php if($errors->any()): ?>
                              <div class="alert alert-danger">
                                  <ul>
                                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <li><?php echo e($error); ?></li>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </ul>
                              </div>
                          <?php endif; ?>
                          <?php if(Session::has('message')): ?>
                            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                          <?php endif; ?>
                          </div>
                          <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
                          <?php else: ?>
                          <div class="row">
                            <div class="col-6 pt-4">
                                <div class="mb-3 pt-2">
                                  <label for="exampleFormControlTextarea1" class="form-label">Company <?php echo e(__('Name')); ?></label>
                                  <input type="text" class="form-control" id="exampleInputPassword1" name="company_name" value="<?php echo e($data->Breeder->company_name ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-6 pt-4">
                              <div class="mb-3 pt-2">
                                <label for="exampleFormControlTextarea1" class="form-label">Owner <?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="owner_name" value="<?php echo e($data->Breeder->owner_name ?? ''); ?>">
                              </div>
                            </div>
                          </div>
                          <?php endif; ?>
                          <div class="row">
                            <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('About')); ?></label>
                                  <textarea class="form-control" id="exampleFormControlTextarea1" name="company_about" rows="3"><?php echo e($data->Breeder->company_about ?? ''); ?></textarea>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 pt-2">
                                <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
                                  <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Profile Picture')); ?></label>
                                <?php else: ?>
                                  <label for="exampleFormControlTextarea1" class="form-label">Company logo</label>
                                <?php endif; ?>  
                                  <div class="custom-file text-center" id="logoFile">
                                    <i class="bi bi-cloud-plus-fill"></i>
                                  </div>
                                  <span id="logoFilename"></span>
                                  <input type="file" name="companylogo" id="logoFileHidden" style="display:none">
                                </div>
                            </div>

                              <div class="col-2">
                                <div class="mb-3 pt-2">
                                  <label for="exampleFormControlTextarea1" class="form-label">Preview</label>
                                  <div class="custom-file text-center">
                                    <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$data->Breeder->logo)); ?>" class="rounded" id="imgPreview" style="height: 75px;width:75px;" alt="No Image" />
                                  </div>
                            </div>

                          </div>
                          <div class="row">
                              <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="phone" class="form-label"><?php echo e(__('Phone')); ?></label>
                                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e($data->Breeder->phone ?? ''); ?>">
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 pt-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($data->email ?? ''); ?>">
                                  </div>
                              </div>
                          </div>
                          <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
                          <?php else: ?>
                          <div class="row">
                              <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="website" class="form-label">URL</label>
                                  <input type="text" class="form-control" id="website" name="website" value="<?php echo e($data->Breeder->website ?? ''); ?>">
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 pt-2">
                                    <label for="fb_url" class="form-label">Facebook Profile link</label>
                                    <input type="text" class="form-control" id="fb_url" name="fb_url" value="<?php echo e($data->Breeder->fb_url ?? ''); ?>">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="insta_url" class="form-label">Instagram Profile link</label>
                                  <input type="text" class="form-control" id="insta_url" name="insta_url" value="<?php echo e($data->Breeder->insta_url ?? ''); ?>">
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 pt-2">
                                    <label for="linkedin_url" class="form-label">LinkedIn Profile link</label>
                                    <input type="text" class="form-control" id="linkedin_url" name="linkedin_url" value="<?php echo e($data->Breeder->linkedin_url ?? ''); ?>">
                                  </div>
                              </div>
                          </div>
                          <?php endif; ?>  
                          <div class="row">
                              <div class="col pt-2">
                                <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Location')); ?></label>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-4">
                                <div class="mb-3 pt-2">
                                  <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?php echo e($data->Breeder->street ?? ''); ?>">
                                </div>
                            </div>
                            <div class="col-4">
                              <div class="mb-3 pt-2">
                                <input type="text" class="form-control" id="city" name="city" placeholder="<?php echo e(__('City')); ?>" value="<?php echo e($data->Breeder->city ?? ''); ?>">
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="mb-3 pt-2">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="country">
                                  <option selected><?php echo e(__('Country')); ?></option>
                                  <option value="Nederland" selected>Nederland</option>
                                </select>
                              </div>
                            </div>

                          </div>
                          <div class="row">
                            <div class="col-6">
                                <div class="mb-3 pt-2">
                                <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
                                  <label for="exampleFormControlTextarea1" class="form-label">Select kind of animals you have</label>
                                <?php else: ?>
                                  <label for="exampleFormControlTextarea1" class="form-label">Select kind of animals you breed</label>
                                <?php endif; ?>    
                                  <select class="form-select mb-3" aria-label=".form-select-lg example" name="kind" id="kindselect">
                                    <option selected>Select</option>
                                    <?php $__currentLoopData = $kinds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kind->id); ?>" <?php if( isset( $data->Breeder->breederKind->kind_id ) and $data->Breeder->breederKind->kind_id == $kind->id ) echo 'selected';?> ><?php echo e($kind->title); ?></option>    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="mb-3 pt-2">
                                <?php if (\Illuminate\Support\Facades\Blade::check('normalUser')): ?>
                                  <label for="exampleFormControlTextarea1" class="form-label">Select <?php echo e(__('Race')); ?> of animals you have</label>
                                <?php else: ?>
                                  <label for="exampleFormControlTextarea1" class="form-label">Select <?php echo e(__('Race')); ?> of animals you <?php echo e(__('breed')); ?></label>
                                <?php endif; ?>    
                                  <select class="form-select mb-3" aria-label=".form-select-lg example" name="race" id="raceselect">
                                    <option selected>Select</option>
                                     <?php $raceMaster = app('App\Repositories\Front\RaceRepository'); ?>
                                <?php
                                if( isset( $data->Breeder->breederKind->kind_id ) ){
                                    $raceResults = $raceMaster->listByKind($data->Breeder->breederKind->kind_id );
                                ?>
                                <?php $__currentLoopData = $raceResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($row->id); ?>" <?php echo e($row->id == $data->Breeder->breederKind->race_id  ? 'selected' : ''); ?> ><?php echo e($row->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php } ?>
                                    </select>
                                    <?php $__errorArgs = ['race'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>


                          </div>
                        </div>
                    </div>
                    </form>
                </div>
                
            </div>

          </div>
      </div>
  </div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>
<script type="text/javascript">
  jQuery(document).ready(function() {
    
  
  jQuery("#logoFile").click(function(e) {
    console.log('logoFile clicked');
    jQuery("#logoFileHidden").click();
});

jQuery('#logoFileHidden').change(function(e){
  var $in=$(this);
  jQuery('#logoFilename').html($in[0].files[0].name);


        const file = $in[0].files[0];
        console.log(file);
        if (file.type=="image/jpeg" || file.type=="image/png"){

          let reader = new FileReader();
          reader.onload = function(event){
            // console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        
        }
      else
      {
         $('<div>Invalid Format</div>').insertAfter('#logoFilename').delay(3000).fadeOut();
            console.log("Invalid Format");
      }

});

jQuery('#kindselect').change(function(e){

var kindid=$(this).val();
if(kindid==""){
  return;
}
showLoader();
$.getJSON("<?php echo e(route('get_races_by_kind')); ?>",{ kindId  : kindid }, function(result) {
  hideLoader();
var $dropdown = $("#raceselect");
$dropdown.empty();
$dropdown.append($("<option />").val("").text("Select"));
$.each(result, function() {
    $dropdown.append($("<option />").val(this.id).text(this.title));
});

});//end json

});





});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/editProfile.blade.php ENDPATH**/ ?>