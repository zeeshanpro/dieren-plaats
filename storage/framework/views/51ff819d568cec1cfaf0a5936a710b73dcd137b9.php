<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('optional_css'); ?>
<link href="https://releases.transloadit.com/uppy/v2.2.1/uppy.min.css" rel="stylesheet">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/my.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>
<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col">
                  <h3><?php echo e(__('Add new ad')); ?></h3>
              </div>
          </div>
          <?php if( $OkToProceed == false ): ?>
          <p class="alert alert-info"><?php echo e($msg); ?></p>
          <?php endif; ?>

          <?php if( $OkToProceed == false ): ?>
            <form method="" action="" >
          <?php else: ?> 
            <form method="post" action="<?php echo e(route('saveadformdetails')); ?>" id="saveadformdetails">
          <?php endif; ?>
          
                                    <?php echo csrf_field(); ?>
          <input type="hidden" name="kind" value="<?php echo e($kindId); ?>" />                         
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>Overview</h2>
                                </div>
                                <div class="col text-end text-grey">
                                <?php echo e(__('Step')); ?>: 2/4
                              </div>
                              <?php $__errorArgs = ['kind'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                              <div class="row">
                                <div class="col-md-6 col-12 pt-4">
                                  <div class="mb-3 pt-2">
                                    <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Animal Rase')); ?></label>
                                    <select class="form-select mb-3" aria-label=".form-select-lg example" name="race">
                                      <option selected><?php echo e(__('Select Option')); ?></option>
                                <?php $raceMaster = app('App\Repositories\Front\RaceRepository'); ?>
                                <?php
                                    $raceResults = $raceMaster->listByKind( $kindId );
                                ?>
                                <?php $__currentLoopData = $raceResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($row->id); ?>" <?php echo e($row->id == old('race')  ? 'selected' : ''); ?> ><?php echo e($row->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                              <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-3 pt-2">
                                      <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Title of your ad')); ?></label>
                                      <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo e(old('title')); ?>"  name="title">
                                      <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3 pt-2">
                                      <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Price')); ?></label>
                                      <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo e(old('amount')); ?>" name="amount">
                                      <?php $__errorArgs = ['amount'];
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
                              <div class="row">
                                  <div class="col-md-6 col-12">
                                    <div class="mb-3 pt-2">
                                      <label for="exampleFormControlTextarea1" class="form-label"><?php echo e(__('Description')); ?></label>
                                      <textarea class="form-control" rows="7" name="desc"><?php echo e(old('desc')); ?></textarea>
                                      <?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div id="drag-drop-area"></div>
                                      <div class="mb-3 pt-2">
                                        
                                      <!--   <label for="exampleFormControlTextarea1" class="form-label">Animal photos</label>
                                          <div class="upload_pic mb-3 pt-2">
                                            <div class="uploaded_pic me-3">
                                                <a href="#" class="delete"><i class="bi bi-x"></i></a>
                                                <img src="images/charles-deluvio.svg" />
                                            </div>
                                            <div class="uploaded_pic me-3">
                                              <a href="#" class="delete"><i class="bi bi-x"></i></a>
                                              <img src="images/charles-deluvio.svg" />
                                            </div>
                                            <div class="custom-file text-center">
                                              <i class="bi bi-cloud-plus-fill"></i>
                                            </div>
                                          </div> -->
                                      </div>
                                  </div>
                                  <?php $__errorArgs = ['filename'];
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
                </div>
                
              </div>

              <div class="col-lg-3 col-md-4 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info d-none d-md-block py-5">
                      <div class="row">
                        <div class="col">
                            <div class="button_block">
                            <?php if( $OkToProceed == false ): ?>
                              <span style="color:red;"><?php echo e($msg); ?></span>
                            <?php endif; ?>
                                    <div class="d-grid gap-2">
                                    <input type="submit" class="btn btn-primary btn-lg" name="Continue" value="<?php echo e(__('Continue')); ?>" />
                                    <a href="#" class="btn btn-info btn-lg"><?php echo e(__('Back')); ?></a>
                                    <a href="#" class="btn btn-lg"><?php echo e(__('Save as draft')); ?></a>
                                    </div>   
                            </div>
                      </div>
                  </div>  
                </div>

                <div class="info d-block d-md-none position-fixed bottom-0 end-0 bg-white w-100 py-4 shadow" style="z-index:999;">
                      <div class="row">
                        <div class="col-6">
                            <div class="button_block">
                            <?php if( $OkToProceed == false ): ?>
                              <span style="color:red;"><?php echo e($msg); ?></span>
                            <?php endif; ?>
                                    <div class="d-grid gap-2">
                                    <input type="submit" class="btn btn-primary" name="Continue" value="<?php echo e(__('Continue')); ?>" />
                                    <!-- <a href="#" class="btn"><?php echo e(__('Save as draft')); ?></a> -->
                                    </div>   
                            </div>
                      </div>
                      <div class="col-6">
                            <div class="button_block">
                                    <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-info"><?php echo e(__('Back')); ?></a>
                                    <!-- <a href="#" class="btn"><?php echo e(__('Save as draft')); ?></a> -->
                                    </div>   
                            </div>
                      </div>
                  </div>  
                </div>

              </div>
            </form> 
          </div>
      </div>
  </div> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('optional_scripts'); ?>
<script src="https://releases.transloadit.com/uppy/v2.2.1/uppy.min.js"></script>
<script>
      var uppy = new Uppy.Core({
        autoProceed: true

      })
        .use(Uppy.Dashboard, {
          inline: true,
          target: '#drag-drop-area',
           showRemoveButtonAfterComplete: true,
        })
            .use(Uppy.XHRUpload, {
      endpoint: '<?php echo e(url("/uploadadfiles")); ?>',
      formData: true,
      fieldName: 'files[]',
      headers: {
        'X-CSRF-Token': "<?php echo e(csrf_token()); ?>"
                  },
      
})
 
      uppy.on('upload-success', (file, response) => {
  const url = response.uploadURL
  const fileName = file.name
let text = "";
response.body.data.forEach(function (item, index) {
  text += index + ": " + item ; 
  jQuery('<input>').attr({
    type: 'hidden',
    id: '',
    name: 'filename[]',
    value:item
}).appendTo('#saveadformdetails');

});

console.log(text);

  // const li = document.createElement('li')
  // const a = document.createElement('a')
  // a.href = url
  // a.target = '_blank'
  // a.appendChild(document.createTextNode(fileName))
  // li.appendChild(a)

  // document.querySelector('.uploaded-files ol').appendChild(li)
})

      uppy.on('file-removed', (file, reason) => {
  if (reason === 'removed-by-user') {
    // sendDeleteRequestForFile(file)
    // alert(file.name);
  }
})


    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/ad/createad_filldetails.blade.php ENDPATH**/ ?>