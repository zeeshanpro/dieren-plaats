@extends('admin/layouts/layout')
@section('title','Transactions')
@section('container')
<!-- <style type="text/css">
  nav .pagination
  {
    justify-content: right;
    margin: 30px 20px 0 0;
  }
</style> -->
<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Unclaimed Gifts</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listing 100</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
              <?php //echo "<pre>";
             // print_r($result);
               ?>
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Sender</th>
                      <th>Gift Type</th>
                      <th>Receiver</th>
                      <th>Initiated On</th>
                      <th>Amount</th>
                      <th>Order #</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if($result->count()<1)
            <tr>
              <td colspan="7">
            <h2 class="text-success text-center">No Record Available</h2>
            </td></tr>
            @endif
                    @foreach($result as $row)
                    <tr>
                      <td>{{$row->sendername}}</td>
                      <td>{{$row->gift_type}}</td>
                      <td class=" text-center"> {{$row->receivername}}</td>
                      <td>{{$row->date_of_creation}}</td>
                      <td>{{$row->amount}}</td>
                      <td>{{$row->order_number}}</td>
                      <td>Open</td>
                    </tr>
                         
                    @endforeach
                   
                  </tbody>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        {{$result->links('pagination::bootstrap-4');}}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    
@endsection

@section('optional_scripts')


@endsection