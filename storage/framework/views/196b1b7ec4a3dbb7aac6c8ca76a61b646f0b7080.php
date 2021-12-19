<?php $__env->startSection('title','Manage Race'); ?>
<?php $__env->startSection('optional_css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin_assets/plugins/toastr/toastr.css')); ?>">
 <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
 <style type="text/css">
#loader {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,125,255,0.5) no-repeat center center;
  z-index: 10000;
}
.content
{
  position: relative;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<section class="content">
            <div id="loader">
 <div class="spinner-border text-light" style="width: 80px; height: 80px; position: absolute; top: 45%;left: 45%;">
    
</div>

</div>

  <!-- Add race -->
<div class="card  card-outline card-info mb-3">
              <div class="card-header">
                <h3 class="card-title">Add New Race</h3>
              </div>
              <div class="card-body row justify-content-center">
                 <div class="col-md-2">
                   <div class="form-group">
                        
                        <select class="form-control bg-info" id="newAttributeKind">
                          <option selected="">Select Kind</option>
                          <?php $__currentLoopData = $kinds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($kind->id); ?>"><?php echo e($kind->title); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </select>
                      </div>

                </div>
                <div class="col-md-2 order-2">
                 
                  <button type="button" class="btn btn-info btn-block" id="addNewRace"><i class="fa fa-save"></i> Save</button>
              </div>

                <div class="col-md-5 order-1">
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-info">Add Race</button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" id="newRaceValue">
                </div>
                </div>

            </div>

            </div>


      <!-- Default box -->
      <div class="card card-outline card-info">
         <div class="card-header">
                
                  <div class="card-tools">
                 <div class="input-group input-group-sm" style="width: 150px;">
                   <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="search">

                   <div class="input-group-append">
                     <button type="submit" class="btn btn-default"><i class="fas fa-search loader"></i></button>
                   </div>
                 </div>
               </div>
              </div>

      
        <div class="card-body">
  <table class="table table-head-fixed table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title </th>
                      <th>Kind </th>
                      <th># of Ads </th>
                      <th># of Expected Babies </th>
                      <th>Action </th>
                    
                    </tr>
                  </thead>
                   <?php echo $__env->make('admin.settings.race_table_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </table>
        </div>
        <!-- /.card-body -->
      
      </div>
      <!-- /.card -->

    </section>

    <div class="modal fade" id="modal-edit-race" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <small class="modal-title text-info">Update Race</small>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p><div class="row justify-content-center">
                 <div class="col-md-4">
                   <div class="form-group">
                        
                        <select class="form-control bg-info" id="updateAttributeKind">
                          <option selected="">Select Kind</option>
                          <?php $__currentLoopData = $kinds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($kind->id); ?>"><?php echo e($kind->title); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </select>
                      </div>

                </div>
                <div class="col-md-8">
                  <div class="input-group ">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-info">Race</button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" id="raceUpdateTitle">
                  <input type="hidden" name="id" id="raceUpdateId" />
                   
                 
                  
                </div>
                

                </div>
              </div></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-info" id="editRace">Update</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>  
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('optional_scripts'); ?>

<script src="<?php echo e(asset('admin_assets/dist/js/ajaxsearch.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/plugins/toastr/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/dist/js/adsrace.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/settings/race.blade.php ENDPATH**/ ?>