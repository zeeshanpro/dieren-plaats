@extends('admin/layouts/layout')
@section('title','Unclaimed Gifts')
@section('container')
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
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Sender</th>
                      <th>Gift Type</th>
                      <th>Receiver</th>
                      <th>Initiated On</th>
                      <th>Amount</th>
                      <th>Days Left</th>
                      <th>Refund Initiated</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Justin Biber</td>
                      <td>Just Cash</td>
                      <td class=" text-center"> Britney Spears</td>
                      <td>22-Aug-2021</td>
                      <td>10.00USD</td>
                      <td>6</td>
                    <td><span class="text-danger ">No</span></td>
                    </tr>
                         <tr>
                      <td>Justin Biber</td>
                      <td>Just Cash</td>
                      <td class=" text-center"> Amanda</td>
                      <td>22-Aug-2021</td>
                      <td>15.00USD</td>
                      <td>6</td>
                    <td><span class="text-success ">Yes</span></td>
                    </tr>
                         <tr>
                      <td>Justin Biber</td>
                      <td>Just Cash</td>
                      <td class=" text-center"> Britney Spears</td>
                      <td>22-Aug-2021</td>
                      <td>20.00USD</td>
                      <td>6</td>
                    <td><span class="text-danger ">No</span></td>
                    </tr>
                         <tr>
                      <td>Justin Biber</td>
                      <td>Just Cash</td>
                      <td class=" text-center"> Randy</td>
                      <td>22-Aug-2021</td>
                      <td>16.00USD</td>
                      <td>6</td>
                    <td><span class="text-success ">Yes</span></td>
                    </tr>
                         <tr>
                      <td>Justin Biber</td>
                      <td>Just Cash</td>
                      <td class=" text-center"> Steve </td>
                      <td>22-Aug-2021</td>
                      <td>30.00USD</td>
                      <td>6</td>
                    <td><span class="text-success ">Yes</span></td>
                    </tr>
                         
                                 <tr>
                      <td>Yet Another</td>
                      <td>Just Cash</td>
                      <td class=" text-center"> Steve </td>
                      <td>22-Aug-2021</td>
                      <td>16.00USD</td>
                      <td>6</td>
                    <td><span class="text-success ">Yes</span></td>
                    </tr>

                   
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
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    
@endsection

@section('optional_scripts')


@endsection