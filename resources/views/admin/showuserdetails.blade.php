@extends('admin/layouts/layout')
@section('title','User Details')
@section('container')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset( $publicPath . 'admin_assets/dist/img/user1-128x1281.jpg')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Laura Storm</h3>

                <p class="text-muted text-center"><a href="#">Edit Profile</a></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Received</b> <a class="float-right">1,322 <small>USD</small></a>
                  </li>
                  <li class="list-group-item">
                    <b>Sent</b> <a class="float-right">543 <small>USD</small></a>
                  </li>
                  <li class="list-group-item">
                    <b>Scheduled</b> <a class="float-right">3</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Block</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Laura</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Default Bank</strong>

                <p class="text-muted">
                  ING, Bank
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, Neatherland</p>

                <hr>

                <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                <p class="text-muted">
                  <span class="tag text-danger">9872414777</span>
                  <span class="tag text-success">9815542895</span>
                   </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                 
                  <li class="nav-item"><a class="nav-link active" href="#transactionhistory" data-toggle="tab">History</a></li>
                  <li class="nav-item"><a class="nav-link" href="#bankinfo" data-toggle="tab">Bank Info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="transactionhistory">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-download bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Received Payment</a> 200 USD</h3>

                          <div class="timeline-body">
                            Description : Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                         
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                    <div>
                        <i class="fas fa-upload bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 14-Aug-2021</span>

                          <h3 class="timeline-header"><a href="#">Sent Payment</a> 100 USD</h3>

                          <div class="timeline-body">
                            Description : Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab,
                          </div>
                         
                        </div>
                      </div>
                      <!-- END timeline item -->
            
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="bankinfo">
                         <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead "><b>HDFC BANK</b></h2>
                     <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small "><span class="fa-li"><i class="fas fa-lg fa-file-invoice-dollar"></i></span> Account No.:  800117722345</li>
                       <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-user-circle"></i></span> Holder:  Laura Storm</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-user-tag"></i></span> Account Type:  Saving</li>
                         <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-route"></i></span> Routing No.: Af234h77</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, Neaderland</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone#: + 800 - 12 12 23 52</li>
                      </ul>

                    </div>
                    <div class="col-5 text-center">
                      <img src="https://www.dialabank.com/wp-content/uploads/2020/12/HDFC-.png" alt="" class=" img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                 
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>


             <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead "><b>ING BANK</b></h2>
                     <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small "><span class="fa-li"><i class="fas fa-lg fa-file-invoice-dollar"></i></span> Account No.:  800117722345</li>
                       <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-user-circle"></i></span> Holder:  Laura Storm</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-user-tag"></i></span> Account Type:  Saving</li>
                         <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-route"></i></span> Routing No.: Af234h77</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, Neaderland</li>
                        <li class="small mt-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone#: + 800 - 12 12 23 52</li>
                      </ul>

                    </div>
                    <div class="col-5 text-center">
                      <img src="https://paymentweek.com/wp-content/uploads/2018/07/ING-logo-v2.jpg" alt="" class=" img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                 
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>


   




        </div>
        </div>
        </div>


                  </div>
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
@endsection

@section('optional_scripts')


@endsection