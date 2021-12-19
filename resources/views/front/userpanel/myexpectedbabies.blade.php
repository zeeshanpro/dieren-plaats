@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH');?>
  @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
  @endsection
@section('container')


<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-3 left_sidebar">
                  <div class="image_box type_3 mb-4">
                    <div class="info">
                        <div class="row">
                            <div class="col col-md-4 left-side">
                                <img src="{{url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')}}" alt="No Logo">
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="name">
                                 {{$Breeder->company_name ?? $Breeder->owner_name}}
                                </div>
                                <div class="reviews pb-2">
                                  @include( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] )
                                  <!-- <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill"></i>  --><span class="text-grey">({{$sellerReport['no_of_reviews']??0}})</span>
                                </div>
                                <span class="badge bg-info">{{$User->usertype ?? 'No User'}}</span>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col">
                                <div class="stats">
                                    {{$User->user_ads_count ?? '0'}} <span class="text-grey">Ad</span>
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
                                <p>{{$Breeder->compay_about ??'Nee '.__('Description').' Added'}}</p>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col">
                              <div class="feature_list pb-2">
                                <img src="{{asset('front_assets/images/paw-grey.svg')}}" />  {{$Breeder->breederKind->breeder_kindKind->title??'none'}}
                              </div>
                              <div class="feature_list pb-2">
                                  <i class="bi bi-geo-alt-fill pe-2"></i>
                                  @php
                                  $address = '';
                                  if( isset( $Breeder->street ) )
                                    $address = $Breeder->street.', ';
                                  if( isset( $Breeder->city ) )
                                    $address .= $Breeder->city.', ';
                                  if(isset($Breeder->country))
                                    $address .= $Breeder->country.'';
                                    else
                                    $address.="Neatherland";
                                @endphp
                                {{$address }}
                              </div>
                              <div class="feature_list pb-2">
                                <i class="bi bi-link-45deg pe-2"></i> <a href="http://{{$Breeder->website??'#'}}" target="_blank">{{$Breeder->website ?? 'No Website'}}</a>
                              </div>
                              <div class="feature_list">
                                <i class="bi bi-telephone-fill pe-2"></i> {{$Breeder->phone ?? 'No Telefoonnummer'}}
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                              <div class="social_links">
                                  @if(isset( $postCreator->fb_url ))
                              <a href="{{$postCreator->fb_url}}"><i class="bi bi-facebook"></i></a>
                              @endif
                              @if(isset( $postCreator->insta_url ))
                              <a href="{{$postCreator->insta_url}}"><i class="bi bi-instagram"></i></a>
                              @endif
                              @if(isset( $postCreator->linkedin_url ))
                              <a href="{{$postCreator->linkedin_url}}"><i class="bi bi-linkedin"></i></a>
                              @endif
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
                            <a href="{{url('profile/'.$userId.'/'. Str::slug($Breeder->owner_name ?? $User->name) )}}">Ads</a>
                            <span class="underline">{{__('Expected Babies')}}</span>
                        </div>
                    </div>
            <div class="col text-end">
            <a href="#" class="add_new_expected_babies text-grey" data-bs-toggle="modal" data-bs-target="#addNewExpectedBabies"><i class="bi bi-plus"></i>  Nieuwe toevoegen {{__('Expected Babies')}}</a>
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
                          {{__('kind')}}
                          </div>
                          <div class="col">
                          {{__('Race')}}
                          </div>
                          <div class="col">
                              Coming {{__('Date')}}
                          </div>
                          <div class="col">
                          {{__('Father')}}
                          </div>
                          <div class="col">
                          {{__('Mother')}}
                          </div>
                          <div class="col">
                          {{__('Waiting list')}}
                          </div>
                          <div class="col-2">
                          </div>
                      </div>
                  </div>
                  @forelse($expectedBabies as $erow)
                      <!-- TABLE TYPE BOX -->
                      <div class="table_type_box">
                          <div class="row top_panel">
                              <div class="col">
                                  <img src="{{url('storage/app/public/uploads/expectedbabies/thumb/'.$erow->father_pic)}}" class="me-2">
                              </div>
                              <div class="col">
                                {{$erow->expected_babieKind->title??'None'}}
                              </div>
                              <div class="col">
                                  {{$erow->expected_babieRace->title??'None'}}
                              </div>
                              <div class="col">
                                  {{date('d/M/Y',strtotime($erow->expected_at))??'None'}}
                              </div>
                              <div class="col">
                                {{$erow->father??'None'}}
                              </div>
                              <div class="col">
                                   {{$erow->mother??'None'}}
                              </div>
                              <div class="col">
                              {{$erow->expected_babie_expected_babies_subscribe_count??'0'}}
                              @if($erow->expected_babie_expected_babies_subscribe_count)
                               (<a href="javascript:void(0);" class="view_waiting_list">view</a>)
                               @endif
                              </div>

                                <div class="col-2 last edit_delete_controls">
                                  <a href="javascript:void(0);" class="me-5" data-bs-toggle="modal" data-bs-target="#modal-edit-expected-babies"  data-expectedDate="{{date('d/M/Y',strtotime($erow->expected_at))}}" data-kind="{{$erow->expected_babieKind->id??''}}" data-race="{{$erow->expected_babieRace->id??''}}" data-father="{{$erow->father??'None'}}" data-mother="{{$erow->mother??'None'}}" data-father_pic="{{$erow->father_pic??''}}" data-mother_pic="{{$erow->mother_pic??''}}" data-ebid="{{$erow->id??'-1'}}">
                                    <i class="bi bi-pencil-fill"> </i></a>
                  <a href="javascript:void(0);" class="" data-id="{{$erow->id??-1}}" id="ebDelete" >
                    <i class="bi bi-trash-fill"></a></i>


                              </div>
                   @if($erow->expected_babie_expected_babies_subscribe_count)
                   @foreach($erow->expected_babieExpectedBabiesSubscribe as $subData)
                  <div class="bottom_panel hide">
                            <div class="row">
                                <div class="col-3 my-2">
                  <div class="feature_list me-4">
                                      <strong>{{__('Waiting list')}}</strong>
                  </div>
                </div>
                                   <div class="col-3 my-2">
                                    <div class="waiting_list">
                                        <img src="{{url('storage/app/public/uploads/users/thumb/'.$subData->expected_babies_subscribeUser->Breeder->logo??'')}}" class="me-2" alt="none">
                                      {{$subData->expected_babies_subscribeUser->Breeder->company_name ??$subData->expected_babies_subscribeUser->name }}
                                    </div>
                                  </div>


                              </div>
                          </div>
                          @endforeach
                          @endif



                          </div>


                      </div>

                      <!-- TABLE TYPE BOX END -->
                      @empty
                      <h3 class="border rounded p-4 m-2">Nee {{__('Expected Babies')}} </h3>
                      @endforelse

                  </div>
              </div>
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                       {{ $expectedBabies->links('pagination::bootstrap-4') }}
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
    <x-loader/>
    <form method="post" enctype="multipart/form-data" id="frmAddExpectedBabies">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLabel"> Nieuwe toevoegen {{__('Expected Babies')}}</h2>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <span id="errormsg" style="color:red;"></span>
    <span id="successmsg" style="color:green;"></span>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3 pt-2">
              <label for="expected_at" class="form-label">Expected {{__('date')}}</label>
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
              @inject( "kindObj" , 'App\Repositories\Front\KindRepository' )
                @php
                $kindResults = $kindObj->listExpectedBabiesWithCount();
                @endphp
                @if( $kindResults['code'] == 200 )
                @foreach ( $kindResults['result'] as $row)
                <option value="{{$row->id}}">{{$row->title}}</option>

                @endforeach
                @endif
              </select>
              <span id="kind_errormsg" style="color:red;"></span>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="race_id" class="form-label">Animal race</label>
            <select class="form-select mb-3" aria-label=".form-select-lg example" id="race_id" name="race_id">
               <option selected="" value="">Select race</option>
              @inject( "raceObj" , 'App\Repositories\Front\RaceRepository' )
                @php
                $raceResults = $raceObj->listExpectedBabiesWithCount();
                @endphp
                @if( $raceResults['code'] == 200 )
                @foreach ( $raceResults['result'] as $row)
                <option value="{{$row->id}}">{{$row->title}}</option>

                @endforeach
                @endif
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
     <x-loader/>
    <form method="post" enctype="multipart/form-data" id="frmUpdateExpectedBabies">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Bewerking {{__('Expected Babies')}}</h5>
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
              @inject( "kindObj" , 'App\Repositories\Front\KindRepository' )
                @php
                $kindResults = $kindObj->listExpectedBabiesWithCount();
                @endphp
                @if( $kindResults['code'] == 200 )
                @foreach ( $kindResults['result'] as $row)
                <option value="{{$row->id}}">{{$row->title}}</option>

                @endforeach
                @endif
              </select>
              <span id="edkind_errormsg"  class="text-danger"></span>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3 pt-2">
            <label for="exampleFormControlTextarea1" class="form-label">Animal race</label>
            <select class="form-select mb-3" aria-label=".form-select-lg example" id="edrace" name="race_id">
               <option selected="">Select race</option>
              @inject( "raceObj" , 'App\Repositories\Front\RaceRepository' )
                @php
                $raceResults = $raceObj->listExpectedBabiesWithCount();
                @endphp
                @if( $raceResults['code'] == 200 )
                @foreach ( $raceResults['result'] as $row)
                <option value="{{$row->id}}">{{$row->title}}</option>

                @endforeach
                @endif
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

          {{-- Images --}}
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
@endsection
@section('optional_scripts')


<script src="{{ asset( $publicPath . 'front_assets/js/addEditEb.js') }}"></script>

@endsection