@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('optional_css')
<link href="https://releases.transloadit.com/uppy/v2.2.1/uppy.min.css" rel="stylesheet">
    <link href="{{ asset( $publicPath . 'front_assets/css/my.css') }}" rel="stylesheet">
@endsection
@section('container')
<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col">
                  <h3>{{__('Add new ad')}}</h3>
              </div>
          </div>
          @if ( $OkToProceed == false )
          <p class="alert alert-info">{{$msg}}</p>
          @endif

          @if ( $OkToProceed == false )
            <form method="" action="" >
          @else 
            <form method="post" action="{{route('saveadformdetails')}}" id="saveadformdetails">
          @endif
          
                                    @csrf
          <input type="hidden" name="kind" value="{{$kindId}}" />                         
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
                                {{__('Step')}}: 2/4
                              </div>
                              @error('kind') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                              <div class="row">
                                <div class="col-md-6 col-12 pt-4">
                                  <div class="mb-3 pt-2">
                                    <label for="exampleFormControlTextarea1" class="form-label">{{__('Animal Rase')}}</label>
                                    <select class="form-select mb-3" aria-label=".form-select-lg example" name="race">
                                      <option selected>{{__('Select Option')}}</option>
                                @inject( "raceMaster" , 'App\Repositories\Front\RaceRepository' )
                                @php
                                    $raceResults = $raceMaster->listByKind( $kindId );
                                @endphp
                                @foreach ( $raceResults['result'] as $row)
                                      <option value="{{ $row->id }}" {{$row->id == old('race')  ? 'selected' : ''}} >{{ $row->title }}</option>
                                @endforeach
                                    </select>
                                    @error('race') <small class="text-danger">{{$message}}</small> @enderror
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-3 pt-2">
                                      <label for="exampleFormControlTextarea1" class="form-label">{{__('Title of your ad')}}</label>
                                      <input type="text" class="form-control" id="exampleInputPassword1" value="{{old('title')}}"  name="title">
                                      @error('title') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3 pt-2">
                                      <label for="exampleFormControlTextarea1" class="form-label">{{__('Price')}}</label>
                                      <input type="text" class="form-control" id="exampleInputPassword1" value="{{old('amount')}}" name="amount">
                                      @error('amount') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6 col-12">
                                    <div class="mb-3 pt-2">
                                      <label for="exampleFormControlTextarea1" class="form-label">{{__('Description')}}</label>
                                      <textarea class="form-control" rows="7" name="desc">{{old('desc')}}</textarea>
                                      @error('desc') <small class="text-danger">{{$message}}</small> @enderror
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
                                  @error('filename') <small class="text-danger">{{$message}}</small> @enderror
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
                            @if ( $OkToProceed == false )
                              <span style="color:red;">{{$msg}}</span>
                            @endif
                                    <div class="d-grid gap-2">
                                    <input type="submit" class="btn btn-primary btn-lg" name="Continue" value="{{__('Continue')}}" />
                                    <a href="#" class="btn btn-info btn-lg">{{__('Back')}}</a>
                                    <a href="#" class="btn btn-lg">{{__('Save as draft')}}</a>
                                    </div>   
                            </div>
                      </div>
                  </div>  
                </div>

                <div class="info d-block d-md-none position-fixed bottom-0 end-0 bg-white w-100 py-4 shadow" style="z-index:999;">
                      <div class="row">
                        <div class="col-6">
                            <div class="button_block">
                            @if ( $OkToProceed == false )
                              <span style="color:red;">{{$msg}}</span>
                            @endif
                                    <div class="d-grid gap-2">
                                    <input type="submit" class="btn btn-primary" name="Continue" value="{{__('Continue')}}" />
                                    <!-- <a href="#" class="btn">{{__('Save as draft')}}</a> -->
                                    </div>   
                            </div>
                      </div>
                      <div class="col-6">
                            <div class="button_block">
                                    <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-info">{{__('Back')}}</a>
                                    <!-- <a href="#" class="btn">{{__('Save as draft')}}</a> -->
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
@endsection

@section('optional_scripts')
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
      endpoint: '{{url("/uploadadfiles")}}',
      formData: true,
      fieldName: 'files[]',
      headers: {
        'X-CSRF-Token': "{{ csrf_token() }}"
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

@endsection