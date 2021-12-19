@extends('admin/layouts/layout')
@section('title','Gifts/Add Gift Category')
@section('container')
<section class="content">

  <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Gift Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="gifttitle">Gift title</label>
                    <input type="text" class="form-control" id="gifttitle" placeholder="Enter Gift Title">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputFile">Choose Gift Icon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose Icon For Category Button</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>

                    <div class="form-group w-50">
                    <label for="buttoncolor">Button Color</label>
                    <input type="text" class="form-control" id="buttoncolor" placeholder="#ff0000">
                  </div>
                   <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="ispublished" rows="3" placeholder="Enter Description"></textarea>
                      </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Published</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                </div>
              </form>
            </div>

          </div></div></div>

      <!-- /.card -->

    </section>
    
@endsection

@section('optional_scripts')


@endsection