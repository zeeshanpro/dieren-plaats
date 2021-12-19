@extends('admin/layouts/layout')
@section('title','List Users')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('container')
<section class="content">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            @if($result->count()<1)
            <div class="col-12 d-flex justify-content-center">
            <h2 class="text-success">No Record Available</h2>
            </div>
            @endif
            @foreach($result as $row)
           <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Neaderland
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{$row->name}}</b></h2>
                      <p class="text-muted text-sm"><b>Received $: 200 <br>Sent $: 200 </b>  </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>{{$row->email}}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone#: {{$row->mobile}}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{ asset( $publicPath . 'admin_assets/dist/img/user1-128x128.jpg')}}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                 
                    <a href="{{url('/admin/userdetails')}}" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
     




          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        {{$result->links('pagination::bootstrap-4');}}
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
@endsection

@section('optional_scripts')


@endsection