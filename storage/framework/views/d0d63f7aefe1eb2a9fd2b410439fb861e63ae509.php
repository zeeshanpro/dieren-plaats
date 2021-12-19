<?php $__env->startSection('title','User Details'); ?>
<?php $__env->startSection('optional_css'); ?>
<style type="text/css">
  .img_style{
    
    width: 100px;
    height: 100px;
  }

.facustom { 
  font-size: 20px;
   padding: 10px;
 
  width: 30px;
  height:30px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 5px; 
}

.facustom:hover {
    opacity: 1;
    color: rgb(230, 230, 230);
}

.fa-facebook {
  background: #3B5998;
  color: white;
}



.fa-linkedin {
  background: #007bb5;
  color: white;
}


.fa-instagram {
  background: #125688;
  color: white;
}


</style>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('container'); ?>
<?php 
// "<pre>".print_r($data);
// exit(1);
 ?>


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <?php if(!isset($data->userAds)): ?>
            <h3>Invalid Data</h3>
            <?php return ?>

            <?php endif; ?>

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if(isset($data->Breeder->logo)): ?>
                  <img class="profile-user-img img-circle img_style" src="<?php echo e(url('storage/app/public/uploads/users/thumb/'.$data->Breeder->logo)); ?>" alt="User profile picture">
                  <?php else: ?>
                 <img class="profile-user-img img-circle img_style" src="<?php echo e(url('public/admin_assets/dist/img/default-150x150.png')); ?>" alt="User profile picture">
                 
                  <?php endif; ?>
                </div>
                <h3 class="profile-username text-center"><?php echo e($data->name ?? 'No Name'); ?></h3>

                <!-- <p class="text-muted text-center"><a href="#">Edit Profile</a></p> -->

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <!-- Add font awesome icons -->
                    <?php if(isset($data->Breeder->fb_url)): ?>
                    <a href="https://<?php echo e($data->Breeder->fb_url); ?>" class="fab facustom fa-facebook" target="_blank"></a>
                    <?php endif; ?>

                    <?php if(isset($data->Breeder->linkedin_url)): ?>
                    <a href="https://<?php echo e($data->Breeder->linkedin_url); ?>" class="fab facustom fa-linkedin" target="_blank"></a>
                    <?php endif; ?>
                    <?php if(isset($data->Breeder->insta_url)): ?>
                    <a href="https://<?php echo e($data->Breeder->insta_url); ?>" class="fab facustom fa-instagram" target="_blank"></a>
                    <?php endif; ?>
                  </li>
                  <li class="list-group-item">
                    <b>Sent</b> <a class="float-right"><small></small></a>
                  </li>
                  <li class="list-group-item">
                    <b>Type: </b><?php echo e($data->usertype??'Unknown'); ?></a>
                  </li>
                 
                </ul>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">About <?php echo e($data->Breeder->company_name ?? ""); ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Company Info</strong>

                <p class="text-muted">
                <?php echo e($data->Breeder->company_about ?? "No Company"); ?>

                </p>

               <!--  <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, Neatherland</p> -->

                <hr>

                <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                <p class="text-muted">
                  <!-- <span class="tag text-danger">9872414777</span> -->
                  <span class="tag text-success"><?php echo e($data->Breeder->phone ?? "No Phone"); ?></span>
                   </p>

                <hr>
                
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                <p class="text-muted">
                 <span class="tag text-success"><?php echo e($data->email ?? "No email"); ?></span>
                   </p>

                <!-- <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-tabs nav-fill">
                 
                  <li class="nav-item"><a  class="<?php echo \Illuminate\Support\Arr::toCssClasses(["nav-link",
                                   "active"=> !$errors->any() & !Session::has('message'),
                                ]) ?>" href="#ads" data-toggle="tab">Ads</a></li>
                  <li class="nav-item"><a class="nav-link" href="#expectedbabies" data-toggle="tab">Expected Babies</a></li>   
                   <li class="nav-item"><a class="<?php echo \Illuminate\Support\Arr::toCssClasses(["nav-link",
                                   "active"=> $errors->any() | Session::has('message'),
                                ]) ?>" href="#userinfo" data-toggle="tab">User Info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <!-- /.tab-pane -->
                  <div  class="<?php echo \Illuminate\Support\Arr::toCssClasses(["tab-pane",
                                   "active"=> !$errors->any() & !Session::has('message'),
                                ]) ?>"
                   id="ads">
                      <?php if(count($data->userAds) <1): ?>
                    
                        <div class="col-12 text-center text-muted py-5">
                                    <h4 class="h4">No Ads Added</h4>
                        </div>
                     <?php endif; ?>

                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->


                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                        <?php $__currentLoopData = $data->userAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="time-label">
                        <span class="bg-warning">
                          <?php echo e($ads->title); ?>

                        </span>
                      </div>
                               <div>
                         <i class="fas fa-info bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> <?php echo e($ads->created_at ?? ""); ?></span>

                          <h3 class="timeline-header"><a href="#">Amount</a> <?php echo e($ads->amount ?? "No Mentioned"); ?> EUR</h3>

                          <div class="timeline-body">
                            Description : <?php echo e($ads->desc ?? "No Description Added"); ?>

                          </div>
                         
                        </div>
                      </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                  </div>
                  <!-- /.tab-pane -->
                      <!-- Bank Info -->
                  <div class="tab-pane" id="expectedbabies">

                     <?php if(count($data->userExpectedBabies) <1): ?>
                    
                        <div class="col-12 text-center text-muted py-5">
                                    <h4 class="h4">No Data Added</h4>
                        </div>
                     <?php endif; ?>

                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->


                        <?php $__currentLoopData = $data->userExpectedBabies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="time-label">
                        <span class="bg-warning">
                          <?php echo e($eads->title); ?>

                        </span>
                      </div>
                               <div>
                         <i class="fas fa-info bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> <?php echo e($eads->created_at ?? ""); ?></span>

                          <h3 class="timeline-header"><a href="#">Parents</a> <?php echo e($eads->father ?? ""); ?> ( Father ) <?php echo e($eads->mother ?? ""); ?> ( Mother ) </h3>

                          <div class="timeline-body">
                            Description : <?php echo e($eads->desc ?? ""); ?>

                          </div>
                         
                        </div>
                      </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                 

                  </div>

                   <!-- /.tab-pane -->
                  <div  class="<?php echo \Illuminate\Support\Arr::toCssClasses(["tab-pane",
                                   "active"=> $errors->any() | Session::has('message'),
                                ]) ?>" id="userinfo">

                    <div class="row">
                      <div class="col-12">
                      <?php if($errors->any()): ?>
                          <div class="callout callout-danger">
                              <ul>
                                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <li><?php echo e($error); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                          </div>
                      <?php endif; ?>
                      <?php if(Session::has('message')): ?>
                         <div class="callout callout-success">
                          <ul><li>
                         <?php echo e(Session::get('message')); ?>

                       </li>
                        </ul>
                     </div>
                      <?php endif; ?>
                      </div>
                    </div> 



                    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Update Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo e(url('admin/update_user')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo e(old('name',$data->name)); ?>">
                    <input type="hidden" name="userId" value="<?php echo e($data->id); ?>">
                  </div> 

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email"  value="<?php echo e(old('email',$data->email)); ?>">
                  </div>

                  
                    <div class="row">
                  
                      <div class="col-6">
                         <div class="form-group">
                    <label for="status">User Status</label>
                    <select name="status" class="custom-select" id="status">
                      <option value="1" <?php echo e((old('status',$data->status)=="1"?' selected':'')); ?>>Active</option>
                      <option value="0" <?php echo e((old('status',$data->status)=="0"?' selected':'')); ?>>Block User</option>
                      
                    </select>

                  </div>
                      </div>
                      <div class="col-6">
                         <div class="form-group">
                    <label for="usertype">User Type</label>
                    <select name="usertype" class="custom-select" id="usertype">
                      <option value="Normal" <?php echo e((old('usertype',$data->usertype)=="Normal"?' selected':'')); ?>>Normal</option>
                      <option value="Shelter" <?php echo e((old('usertype',$data->usertype)=="Shelter"?' selected':'')); ?>>Shelter</option>
                      <option value="Breeder" <?php echo e((old('usertype',$data->usertype)=="Breeder"?' selected':'')); ?>>Breeder</option>
                    </select>

                  </div>
                      </div>
                  
                    </div>
                  

                 
                  <div class="form-group">
                    <label for="ownername">Owner Name</label>
                    <input type="text" class="form-control" id="ownername" placeholder="Enter Owner Name" name="owner_name"  value="<?php echo e(old('owner_name',$data->Breeder->owner_name ?? '')); ?>">
                  </div>

                  <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" placeholder="Enter company name" name="company_name"   value="<?php echo e(old('company_name',$data->Breeder->company_name ?? '')); ?>">
                  </div> 
                  
                  <div class="container">
                    <div class="row">
                  
                      <div class="col-4 pl-0">
                        <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="Enter city" name="city"   value="<?php echo e(old('city',$data->Breeder->city ?? '')); ?>">
                  </div> 
                      </div>
                  
                     <div class="col-4 pl-0">
                        <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" placeholder="Enter state" name="state"   value="<?php echo e(old('state',$data->Breeder->state ?? '')); ?>">
                  </div> 
                      </div>


                         <div class="col-4 pl-0">
                        <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" placeholder="Enter country" name="country"   value="<?php echo e(old('country',$data->Breeder->country ?? '')); ?>" disabled="">
                  </div> 
                      </div>




                  
                    </div>
                  </div>

                  
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone"   value="<?php echo e(old('phone',$data->Breeder->phone ?? '')); ?>">
                  </div>  
                  

                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" placeholder="Enter Website Url" name="website"   value="<?php echo e(old('website',$data->Breeder->website ?? '')); ?>">
                  </div>  



                  <div class="form-group">
                    <label for="fb_url">FB Url</label>
                    <input type="text" class="form-control" id="fb_url" placeholder="Enter Facebook Url" name="fb_url"   value="<?php echo e(old('fb_url',$data->Breeder->fb_url ?? '')); ?>">
                  </div>  


                  <div class="form-group">
                    <label for="insta_url">Instagram Url</label>
                    <input type="text" class="form-control" id="fb_url" placeholder="Enter Instagram Url" name="insta_url"   value="<?php echo e(old('insta_url',$data->Breeder->insta_url ?? '')); ?>">
                  </div>  


                  <div class="form-group">
                    <label for="linkedin_url">Linkedin Url</label>
                    <input type="text" class="form-control" id="linkedin_url" placeholder="Enter Website Url" name="linkedin_url"   value="<?php echo e(old('linkedin_url',$data->Breeder->linkedin_url ?? '')); ?>">
                  </div>  

                  
                  
                  
                 <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </form>
            </div>


                      
                  </div>

                  <!-- Bank Info Ends Here -->


                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('optional_scripts'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/admin/user/userdetail.blade.php ENDPATH**/ ?>