<?php $__env->startSection('title','Manage Kind'); ?>
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
  background: rgba(0,125,255,0.5) url("<?php echo e(asset('admin_assets/dist/img/nTw.gif')); ?>") no-repeat center center;
  z-index: 10000;
}
.content
{
  position: relative;
}
.imageStyle
{
  width: 75px;
  height: auto;
  border-radius: 5px;
}
.containerImage {
  position: relative;
  width: 75px;
  max-width: 75px;
  float: left;
  cursor: pointer;
}

.overlayImage {
  position: absolute; 
  bottom: 18px; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 100%;
  opacity:0;
  -webkit-transition: all .5s ease|linear|ease-in|ease-out|ease-in-out|cubic-bezier(<number>,<number>,<number>,<number>);
     -moz-transition: all .5s ease|linear|ease-in|ease-out|ease-in-out|cubic-bezier(<number>,<number>,<number>,<number>);
      -ms-transition: all .5s ease|linear|ease-in|ease-out|ease-in-out|cubic-bezier(<number>,<number>,<number>,<number>);
       -o-transition: all .5s ease|linear|ease-in|ease-out|ease-in-out|cubic-bezier(<number>,<number>,<number>,<number>);
          transition: all .5s ease|linear|ease-in|ease-out|ease-in-out|cubic-bezier(<number>,<number>,<number>,<number>);
  color: white;
  font-size: 12px;
  padding: 0px;
  text-align: center;
  display: block;
}
.containerImage:hover .overlayImage
{
  opacity: 1;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('container'); ?>
<?php

// echo "<pre>";
// print_r($result);

?>
<section class="content">
         <div id="loader">
<!--  <div class="spinner-border text-light" style="width: 80px; height: 80px; position: absolute; top: 45%;left: 45%;">
    
</div> -->

</div>

<!-- Add kind -->
<div class="card  card-outline card-info mb-3">
              <div class="card-header">
                <h3 class="card-title">Add New Kind</h3>
              </div>
              <form id="kindform" enctype="multipart/form-data" method="post">
              <div class="card-body row justify-content-center align-items-center">
                 <div class="col-md-1 text-center">
                    <a class="btn btn-app m-0"   id="kindIconImageUpload" style="cursor:pointer;">
                  
                  <i class="fas fa-upload text-gray"></i> Upload Icon
                </a>
                
                <input type="file" name="kindIconImage" id="kind_icon_file" style="display: none;" />

                  </div>


                  <div class="col-md-1 text-center">
                    <a class="btn btn-app m-0"   id="kindImageUpload" style="cursor:pointer;">
                  
                  <i class="fas fa-upload text-gray"></i> Upload Pic
                </a>
                
                <input type="file" name="kindImage" id="kind_file" style="display: none;" />

                  </div>
                <div class="col-md-2 order-2">
                 
                  <button class="btn btn-info btn-block" id="addNewKind"><i class="fa fa-save"  ></i> Save</button>
              </div>

                <div class="col-md-5 order-1">
                  <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-info">Add Kind</button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" name="title"  id="newKindValue" placeholder="Enter Kind Title">
                </div>
                </div>

            </div>
          <div class="card card-footer" >
            <div class="callout callout-success" style="display: none;" id="kindiconfilenamediv">
                 <p>Icon : <span id="kindiconfilename"  style="font-size:12px;color:gray"></span></p>
                </div>  
                 <div class="callout callout-success" style="display: none;" id="kindfilenamediv">
                  <p>Image: <span id="kindfilename"  style="font-size:12px;color:gray"></span></p>
                </div>


          </div>
            </form>

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
                <table class="table table-head-fixed table-striped" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title </th>
                      <th># of Ads </th>
                      <th># of Breeders </th>
                      <th># of Expected Babies </th>
                      <th>Action </th>
                     
                    </tr>
                  </thead>
                 
                   <?php echo $__env->make('admin.settings.kind_table_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
                 
                </table>
        </div>
        <!-- /.card-body -->
  
      </div>
      <!-- /.card -->
 <div class="modal fade" id="modal-edit-kind" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
        <form id="kindeditform" enctype="multipart/form-data" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <small class="modal-title text-info">Update Kind</small>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>

                <div class="row justify-content-center align-items-center"> 


               <div class="col-md-11 mb-2"> 
                
                  <div class="input-group ">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-info">Kind</button>
                  </div>
                  <!-- /btn-group -->

                  <input type="text" class="form-control" id="kindUpdateTitle" name="title">
                 
                  <input type="hidden" name="kindid" id="kindUpdateId" />
                   
                </div>

                </div>

                  <div class="col-md-3 mr-1">
                  <div class="containerImage" id="kindImageIconEditUpload">
                     <img class=" imageStyle" id="kindUpdateImageIconPreview" alt="" >
                     <span class="overlayImage py-2">
                       <i class="fas fa-upload"></i>
                     </span>
                     <small class="text-center d-block">Icon</small>
                  </div>
                  <span id="kindiconeditfilename" class="d-block" style="font-size:12px;color:gray"></span>
                <input type="file" name="kindIconImage" id="kind_icon_edit_file" style="display: none;" />
                  
                </div>
                  
                <div class="col-md-2">
                  <div class="containerImage" id="kindImageEditUpload">
                     <img class=" imageStyle" id="kindUpdateImagePreview" alt="" >
                     <span class="overlayImage py-2">
                       <i class="fas fa-upload"></i>
                     </span>
                     <small class="text-center d-block">Image</small>
                  </div>
                  <span id="kindeditfilename" class="d-block" style="font-size:12px;color:gray"></span>
                <input type="file" name="kindImage" id="kind_edit_file" style="display: none;" />
                  
                </div>
              
              </div>
              
            </p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-info" id="editKind">Update</button>
            </div>
          </div>
          </form>

        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>  
    
    </section>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('optional_scripts'); ?>

<script src="<?php echo e(asset('admin_assets/dist/js/ajaxsearch.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/plugins/toastr/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/dist/js/adskind.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/settings/kind.blade.php ENDPATH**/ ?>