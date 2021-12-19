<?php $publicPath = env('ASSETS_PATH');?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>


<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-3 left_sidebar">
                  <div class="image_box type_3 mb-4">
                    <div class="info">
                        <div class="row">
                            <div class="col col-md-4 left-side">
                                <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')); ?>" alt="No Logo">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="name">
                                 <?php echo e($Breeder->company_name ?? $Breeder->owner_name); ?>

                                </div>
                                <div class="reviews pb-2">
                                  <?php echo $__env->make( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                  <!-- <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill"></i>  --><span class="text-grey">(<?php echo e($sellerReport['no_of_reviews']??0); ?>)</span>
                                </div>
                                <span class="badge bg-info"><?php echo e($User->usertype ?? 'No User'); ?></span>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col">
                                <div class="stats">
                                    <?php echo e($User->user_ads_count ?? '0'); ?> <span class="text-grey">Ad</span>
                                </div>
                            </div>
                            <div class="col-8">
                              <div class="stats">
                                200 <span class="text-grey">View</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col pt-3">
                                <p><?php echo e($Breeder->compay_about ??'Nee '.__('Description').' Added'); ?></p>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col">
                              <div class="feature_list pb-2">
                                <img src="<?php echo e(asset('front_assets/images/paw-grey.svg')); ?>" />  <?php echo e($Breeder->breederKind->breeder_kindKind->title??'none'); ?>

                              </div>
                              <div class="feature_list pb-2">
                                  <i class="bi bi-geo-alt-fill pe-2"></i>
                                  <?php
                                  $address = '';
                                  if( isset( $Breeder->street ) )
                                    $address = $Breeder->street.', ';
                                  if( isset( $Breeder->city ) )
                                    $address .= $Breeder->city.', ';
                                  if(isset($Breeder->country))
                                    $address .= $Breeder->country.'';
                                    else
                                    $address.="Neatherland";
                                ?>
                                <?php echo e($address); ?>

                              </div>
                              <div class="feature_list pb-2">
                                <i class="bi bi-link-45deg pe-2"></i> <a href="http://<?php echo e($Breeder->website??'#'); ?>" target="_blank"><?php echo e($Breeder->website ?? 'No Website'); ?></a>
                              </div>
                              <div class="feature_list">
                                <i class="bi bi-telephone-fill pe-2"></i> <?php echo e($Breeder->phone ?? 'No Telefoonnummer'); ?>

                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                              <div class="social_links">
                                  <?php if(isset( $postCreator->fb_url )): ?>
                              <a href="<?php echo e($postCreator->fb_url); ?>"><i class="bi bi-facebook"></i></a>
                              <?php endif; ?>
                              <?php if(isset( $postCreator->insta_url )): ?>
                              <a href="<?php echo e($postCreator->insta_url); ?>"><i class="bi bi-instagram"></i></a>
                              <?php endif; ?>
                              <?php if(isset( $postCreator->linkedin_url )): ?>
                              <a href="<?php echo e($postCreator->linkedin_url); ?>"><i class="bi bi-linkedin"></i></a>
                              <?php endif; ?>
                              </div>
                          </div>
                        </div>
                    </div>
                  </div>

              </div>
              <!-- RIGHT MAIN PANEL -->
             <div class="col-md-9">
                <div class="row">
                    <div class="col">
                        <div class="inner_page_top_tabs">
                            <a href="<?php echo e(url('profile/'.$userId.'/'. Str::slug($Breeder->owner_name ?? $User->name) )); ?>">Ads</a>
                            <span class="underline"><?php echo e(__('Expected Babies')); ?></span>
                        </div>
                    </div>
            <div class="col text-end">
            <a href="#" class="add_new_expected_babies text-grey" data-bs-toggle="modal" data-bs-target="#addNewExpectedBabies"><i class="bi bi-plus"></i>  Nieuwe toevoegen <?php echo e(__('Expected Babies')); ?></a>
          </div>


                </div>
                <div class="row">
                  <div class="col">
                    <div class="table_type_box_header">
                      <div class="row top_panel text-grey">
                          <div class="col">
                              Parent
                          </div>
                          <div class="col">
                          <?php echo e(__('kind')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Race')); ?>

                          </div>
                          <div class="col">
                              Coming <?php echo e(__('Date')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Father')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Mother')); ?>

                          </div>
                          <div class="col">
                          <?php echo e(__('Waiting list')); ?>

                          </div>
                          <div class="col-2">
                          </div>
                      </div>
                  </div>
                  <?php $__empty_1 = true; $__currentLoopData = $expectedBabies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <!-- TABLE TYPE BOX -->
                      <div class="table_type_box">
                          <div class="row top_panel">
                              <div class="col">
                                  <img src="<?php echo e(url('storage/app/public/uploads/expectedbabies/thumb/'.$erow->father_pic)); ?>" class="me-2">
                              </div>
                              <div class="col">
                                <?php echo e($erow->expected_babieKind->title??'None'); ?>

                              </div>
                              <div class="col">
                                  <?php echo e($erow->expected_babieRace->title??'None'); ?>

                              </div>
                              <div class="col">
                                  <?php echo e(date('d/M/Y',strtotime($erow->expected_at))??'None'); ?>

                              </div>
                              <div class="col">
                                <?php echo e($erow->father??'None'); ?>

                              </div>
                              <div class="col">
                                   <?php echo e($erow->mother??'None'); ?>

                              </div>
                              <div class="col">
                              <?php echo e($erow->expected_babie_expected_babies_subscribe_count??'0'); ?>

                              <?php if($erow->expected_babie_expected_babies_subscribe_count): ?>
                               (<a href="javascript:void(0);" class="view_waiting_list">view</a>)
                               <?php endif; ?>
                              </div>

                                <div class="col-2 last edit_delete_controls">
                                  <a href="javascript:void(0);" class="me-5" data-bs-toggle="modal" data-bs-target="#modal-edit-expected-babies"  data-expectedDate="<?php echo e(date('d/M/Y',strtotime($erow->expected_at))); ?>" data-kind="<?php echo e($erow->expected_babieKind->id??''); ?>" data-race="<?php echo e($erow->expected_babieRace->id??''); ?>" data-father="<?php echo e($erow->father??'None'); ?>" data-mother="<?php echo e($erow->mother??'None'); ?>" data-father_pic="<?php echo e($erow->father_pic??''); ?>" data-mother_pic="<?php echo e($erow->mother_pic??''); ?>" data-ebid="<?php echo e($erow->id??'-1'); ?>">
                                    <i class="bi bi-pencil-fill"> </i></a>
                  <a href="javascript:void(0);" class="" data-id="<?php echo e($erow->id??-1); ?>" id="ebDelete" >
                    <i class="bi bi-trash-fill"></a></i>


                              </div>
                   <?php if($erow->expected_babie_expected_babies_subscribe_count): ?>
                   <?php $__currentLoopData = $erow->expected_babieExpectedBabiesSubscribe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="bottom_panel hide">
                            <div class="row">
                                <div class="col-3 my-2">
                  <div class="feature_list me-4">
                                      <strong><?php echo e(__('Waiting list')); ?></strong>
                  </div>
                </div>
                                   <div class="col-3 my-2">
                                    <div class="waiting_list">
                                        <img src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$subData->expected_babies_subscribeUser->Breeder->logo??'')); ?>" class="me-2" alt="none">
                                      <?php echo e($subData->expected_babies_subscribeUser->Breeder->company_name ??$subData->expected_babies_subscribeUser->name); ?>

                                    </div>
                                  </div>


                              </div>
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>



                          </div>


                      </div>

                      <!-- TABLE TYPE BOX END -->
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <h3 class="border rounded p-4 m-2">Nee <?php echo e(__('Expected Babies')); ?> </h3>
                      <?php endif; ?>

                  </div>
              </div>
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                       <?php echo e($expectedBabies->links('pagination::bootstrap-4')); ?>

                  </div>
                  <div class="col-auto">

                  </div>
              </div>

            </div>

          </div>
      </div>
  </div>


  <!-- Modal -->

  <div class="modal fade" id="addNewExpectedBabies" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.loader','data' => []]); ?>
<?php $component->withName('loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <form method="post" enctype="multipart/form-data" id="frmAddExpectedBabies">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLabel"> Nieuwe toevoegen <?php echo e(__('Expected Babies')); ?></h2>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <span id="errormsg" style="color:red;"></span>
    <span id="successmsg" style="color:green;"></span>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="expected_at" class="form-label">Expected <?php echo e(__('date')); ?></label>
              <input type="date" class="form-control" name="expected_at" id="expected_at">
              <span id="expected_at_errormsg" style="color:red;"></span>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Subscription</label>
            <select class="form-select mb-3" aria-label=".form-select-lg example">
              <option selected="" >Enabled</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              </select>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="kind_id" class="form-label">Animal kind</label>

              <select class="form-select mb-3" aria-label=".form-select-lg example" id="kind_id" name="kind_id">
                 <option selected="" value="">Select Kind</option>
              <?php $kindObj = app('App\Repositories\Front\KindRepository'); ?>
                <?php
                $kindResults = $kindObj->listExpectedBabiesWithCount();
                ?>
                <?php if( $kindResults['code'] == 200 ): ?>
                <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($row->id); ?>"><?php echo e($row->title); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
              <span id="kind_errormsg" style="color:red;"></span>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="race_id" class="form-label">Animal race</label>
            <select class="form-select mb-3" aria-label=".form-select-lg example" id="race_id" name="race_id">
               <option selected="" value="">Select race</option>
              <?php $raceObj = app('App\Repositories\Front\RaceRepository'); ?>
                <?php
                $raceResults = $raceObj->listExpectedBabiesWithCount();
                ?>
                <?php if( $raceResults['code'] == 200 ): ?>
                <?php $__currentLoopData = $raceResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($row->id); ?>"><?php echo e($row->title); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
              <span id="race_errormsg" style="color:red;"></span>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="mother" class="form-label">Mother name</label>
              <input type="text" class="form-control" name="mother" id="mother">
              <span id="mother_errormsg" style="color:red;"></span>
            </div>
          </div>

          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="father" class="form-label">Father name</label>
            <input type="text" class="form-control" name="father" id="father">
            <span id="father_errormsg" style="color:red;"></span>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-3">
              <div class="mb-3 pt-2">
               <label for="exampleFormControlTextarea1" class="form-label d-block" id="logoFilenameMother">File Name</label>
              <img class="rounded"  alt="No Image" id="imgMotherPreview" style="width:100px;height:100px">

            </div>
            </div>
          <div class="col-3">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Mother photo</label>
              <div class="upload_pic mb-3 pt-2" id="logoFileMother">
             <div class="custom-file text-center">
                <i class="bi bi-cloud-plus-fill"></i>
              </div>

              </div>
              <input type="file" name="mother_pic" id="logoFileMotherHidden" style="display:none">
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-3">
              <div class="mb-3 pt-2">
               <label for="exampleFormControlTextarea1" class="form-label d-block" id="logoFilenameFather">File Name</label>
              <img class="rounded"  alt="No Image" id="imgFatherPreview" style="width:100px;height:100px">

            </div>
            </div>

           <div class="col-3">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Father photo</label>
              <div class="upload_pic mb-3 pt-2"  id="logoFileFather">
              <div class="custom-file text-center">
                <i class="bi bi-cloud-plus-fill"></i>
              </div>
              </div>
              <input type="file" name="father_pic" id="logoFileFatherHidden" style="display:none">
            </div>
          </div>



        </div>
      </div>
      <div class="modal-footer aligned_right">
        <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Discard</button>
        <button type="button" id="btnAddExpectedBabies" class="btn btn-primary btn-lg">Add</button>
      </div>
    </div>
    </div>
    </form>
  </div>




  <!-- // Modal Edit Expected Babies -->

   <!-- Modal -->
  <div class="modal fade" id="modal-edit-expected-babies" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.loader','data' => []]); ?>
<?php $component->withName('loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <form method="post" enctype="multipart/form-data" id="frmUpdateExpectedBabies">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Bewerking <?php echo e(__('Expected Babies')); ?></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <span id="ederrormsg" class="text-danger"></span>
    <span id="edsuccessmsg" class="text-success"></span>

      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="exampleFormControlTextarea1" class="form-label">Expected date</label>
              <input type="date" class="form-control"  name="expected_at" id="edexpectedData">
               <span id="edexpected_at_errormsg"  class="text-danger"></span>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Subscription</label>
            <select class="form-select mb-3" aria-label=".form-select-lg example">
              <option selected="">Enabled</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
              </select>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="exampleFormControlTextarea1" class="form-label">Animal kind</label>

              <select class="form-select mb-3" aria-label=".form-select-lg example" id="edkind" name="kind_id">
                 <option selected="">Select Kind</option>
              <?php $kindObj = app('App\Repositories\Front\KindRepository'); ?>
                <?php
                $kindResults = $kindObj->listExpectedBabiesWithCount();
                ?>
                <?php if( $kindResults['code'] == 200 ): ?>
                <?php $__currentLoopData = $kindResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($row->id); ?>"><?php echo e($row->title); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
              <span id="edkind_errormsg"  class="text-danger"></span>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Animal race</label>
            <select class="form-select mb-3" aria-label=".form-select-lg example" id="edrace" name="race_id">
               <option selected="">Select race</option>
              <?php $raceObj = app('App\Repositories\Front\RaceRepository'); ?>
                <?php
                $raceResults = $raceObj->listExpectedBabiesWithCount();
                ?>
                <?php if( $raceResults['code'] == 200 ): ?>
                <?php $__currentLoopData = $raceResults['result']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($row->id); ?>"><?php echo e($row->title); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </select>
              <span id="edrace_errormsg"  class="text-danger"></span>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="exampleFormControlTextarea1" class="form-label">Mother name</label>
              <input type="text" class="form-control" name="mother" id="edit_mother">
               <span id="edmother_errormsg"  class="text-danger"></span>
            </div>
          </div>

          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Father name</label>
            <input type="text" class="form-control" name="father" id="edit_father">
             <span id="edfather_errormsg"  class="text-danger"></span>
            </div>
          </div>
          </div>

          
          <div class="row">
            <div class="col-3">
              <div class="mb-3 pt-2 text-center">
               <label for="exampleFormControlTextarea1" class="form-label d-block" id="edlogoFilenameMother">Current Pic</label>
              <img class="rounded"  alt="No Image" id="edimgMotherPreview" style="width:100px;height:100px">

            </div>
            </div>
          <div class="col-3">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Mother photo</label>
              <div class="upload_pic mb-3 pt-2" id="edlogoFileMother">
             <div class="custom-file text-center">
                <i class="bi bi-cloud-plus-fill"></i>
              </div>

              </div>
              <input type="file" name="mother_pic" id="edlogoFileMotherHidden" style="display:none">
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-3">
              <div class="mb-3 pt-2 text-center">
               <label for="exampleFormControlTextarea1" class="form-label d-block" id="edlogoFilenameFather">Current Pic</label>
              <img class="rounded"  alt="No Image" id="edimgFatherPreview" style="width:100px;height:100px">

            </div>
            </div>

           <div class="col-3">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Father photo</label>
              <div class="upload_pic mb-3 pt-2"  id="edlogoFileFather">
              <div class="custom-file text-center">
                <i class="bi bi-cloud-plus-fill"></i>
              </div>
              </div>
              <input type="file" name="father_pic" id="edlogoFileFatherHidden" style="display:none">
            </div>
          </div>

            <input type="hidden"  name="ebId" value="" id="ebId">

        </div>
      </div>
      <div class="modal-footer aligned_right">
        <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Discard</button>
        <button type="button"  id="btnUpdateExpectedBabies"  class="btn btn-primary btn-lg">Update</button>
      </div>
    </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>


<script src="<?php echo e(asset( $publicPath . 'front_assets/js/addEditEb.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/userpanel/myexpectedbabies.blade.php ENDPATH**/ ?>