@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('optional_css')
<meta content="{{ csrf_token() }}" name="csrf-token"/>
<link href="{{ asset( $publicPath . 'front_assets/css/my.css') }}" rel="stylesheet">
    @endsection
@section('container')
    <div class="inner_page_content_area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-12">
                   <h2 class="border rounded  p-5 text-center">Binnenkort beschikbaar !</h2>
                </div>
             {{--    <div class="col-xs-5 col-5">
                    <!-- Button trigger modal -->
                    <button class="btn btn-info d-block d-lg-none mb-4" data-bs-target="#filters_menu" data-bs-toggle="modal" type="button">
                        <i class="bi bi-funnel-fill me-1">
                        </i>
                        Filters
                    </button>
                </div>
                <div class="col-xs-5 col-7 d-flex justify-content-end">
                    <div class="mr-1 w-50 d-block d-lg-none">
                        <select aria-label=".form-select-lg example" class="form-select mb-3" id="dropsort" name="dropsort">
                            <option selected="" value="null">
                                {{__('Sort by')}}
                            </option>
                            <option value="dateasc">
                                {{__('Latest First')}}
                            </option>
                            <option value="datedesc">
                                Oldest First
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-lg-2 left_sidebar d-none d-lg-block" id="desktopFilter">
                    <h2>
                        {{__('Filter by')}}
                    </h2>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button aria-controls="flush-collapseOne" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseOne" data-bs-toggle="collapse" type="button">
                                {{__('kind')}}
                                </button>
                            </h2>
                            <div aria-labelledby="flush-headingOne" class="accordion-collapse collapse show" id="flush-collapseOne">
                                <div class="accordion-body">
                                    @inject( "kindObj" , 'App\Repositories\Front\KindRepository' )
                        @php
                            $kindResults = $kindObj->listExpectedBabiesWithCount();
                        @endphp
                          @if( $kindResults['code'] == 200 )
                              @foreach ( $kindResults['result'] as $row)
                                    <div class="form-check">
                                        <input class="form-check-input filter filterKind " data-belongs_to_attribute="Kind" data-filter_column="kindId" id="kind_{{$row->id}}" name="kind" type="radio" value="{{$row->id}}">
                                            <label class="form-check-label" for="kind_{{$row->id}}">
                                                {{$row->title}}
                                                <span>
                                                    ( 
                                  @if ( isset( $kindResults['noOfExpectedBabiesArray'][ $row->id ] ) )
                                    {{$kindResults['noOfExpectedBabiesArray'][ $row->id ]}}
                                  @else
                                    0
                                  @endif
                                  )
                                                </span>
                                            </label>
                                        </input>
                                    </div>
                                    @endforeach
                          @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button aria-controls="flush-collapseTwo" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseTwo" data-bs-toggle="collapse" type="button">
                                    Coming {{__('date')}}
                                </button>
                            </h2>
                            <div aria-labelledby="flush-headingTwo" class="accordion-collapse collapse show" id="flush-collapseTwo">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m1" name="comingmonth" type="radio" value="1">
                                            <label class="form-check-label" for="m1">
                                                {{date('F',strtotime('+1 month'))}}
                                            </label>
                                        </input>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m2" name="comingmonth" type="radio" value="2">
                                            <label class="form-check-label" for="m2">
                                                {{date('F',strtotime("+2 month"))}}
                                            </label>
                                        </input>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m3" name="comingmonth" type="radio" value="3">
                                            <label class="form-check-label" for="m3">
                                                {{date('F',strtotime("+3 month"))}}
                                            </label>
                                        </input>
                                    </div>
                                    <div class="row g-0 range">
                                        <div class="col">
                                            <input class="form-control dateCol" id="minrangetext" placeholder="€" type="date">
                                            </input>
                                        </div>
                                        <div class="col-12 text-center dateCol">
                                            To
                                        </div>
                                    </div>
                                    <div class="row g-0 range">
                                        <div class="col">
                                            <input class="form-control dateCol" id="maxrangetext" placeholder="€" type="date">
                                            </input>
                                        </div>
                                        <div class="col">
                                            <button id="customDate">
                                                <i class="bi bi-chevron-right">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button aria-controls="flush-collapseThree" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseThree" data-bs-toggle="collapse" type="button">
                                {{__('Race')}}
                                </button>
                            </h2>
                            <div aria-labelledby="flush-headingThree" class="accordion-collapse collapse show" id="flush-collapseThree">
                                <div class="accordion-body">
                                    @inject( "raceObj" , 'App\Repositories\Front\RaceRepository' )
                        @php
                            $raceResults = $raceObj->listExpectedBabiesWithCount();
                        @endphp
                          @if( $raceResults['code'] == 200 )
                              @foreach ( $raceResults['result'] as $row)
                                    <div class="form-check">
                                        <input class="form-check-input filter filterRace" data-belongs_to_attribute="Race" data-filter_column="raceId" id="race_{{$row->id}}" name="race[]" type="checkbox" value="{{$row->id}}">
                                            <label class="form-check-label" for="race_{{$row->id}}">
                                                {{$row->title}}
                                                <span>
                                                    ( 
                                  @if ( isset( $raceResults['noOfExpectedBabiesArray'][ $row->id ] ) )
                                    {{$raceResults['noOfExpectedBabiesArray'][ $row->id ]}}
                                  @else
                                    0
                                  @endif
                                  )
                                                </span>
                                            </label>
                                        </input>
                                    </div>
                                    @endforeach
                          @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button aria-controls="flush-collapseFour" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseFour" data-bs-toggle="collapse" type="button">
                                    Subscription
                                </button>
                            </h2>
                            <div aria-labelledby="flush-headingFour" class="accordion-collapse collapse show" id="flush-collapseFour">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input filter filterSubscription" data-belongs_to_attribute="Subscription" id="sub" type="checkbox" value="sub">
                                            <label class="form-check-label" for="sub">
                                                Subscribed
                                            </label>
                                        </input>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input filter filterSubscription" data-belongs_to_attribute="Subscription" id="unsub" type="checkbox" value="unsub">
                                            <label class="form-check-label" for="unsub">
                                                Un-Subscribed
                                            </label>
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- RIGHT MAIN PANEL -->
                <div class="col-md-10">
                    <div class="row">
                        <x-loader>
                        </x-loader>
                        <div class="col">
                            <h2>
                                {{__('Expected Babies')}}
                            </h2>
                            <p class="text-grey">
                                20 of 200
                            </p>
                        </div>
                        <div class="col text-end d-flex justify-content-end mx-2">
                            <div class="mb-3 pt-2 w-50 d-none d-lg-block">
                                <select aria-label=".form-select-lg example" class="form-select mb-3" id="dropsort" name="dropsort">
                                    <option selected="" value="null">
                                        {{__('Sort by')}}
                                    </option>
                                    <option value="dateasc">
                                        {{__('Latest First')}}
                                    </option>
                                    <option value="datedesc">
                                    {{__('Oldest First')}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col" id="ftag">
                            <a href="javascript:void(0);" id="clearall">
                            {{__('clear all')}}
                            </a>
                        </div>
                    </div>
                    @include('front.layout.components.ebListBridge', $expectedBabies )
                </div> --}}
            </div>
        </div>
    </div>
    <!-- FILTERS POPUP FOR MOBILE -->
    <div aria-hidden="true" aria-labelledby="staticBackdropLabel" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="filters_menu" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Filter Results
                    </h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-3 col-lg-2 left_sidebar">
                        <h2>
                            {{__('Filter by')}}
                        </h2>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button aria-controls="flush-collapseOne" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseOne" data-bs-toggle="collapse" type="button">
                                    {{__('kind')}}
                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingOne" class="accordion-collapse collapse show" id="flush-collapseOne">
                                    <div class="accordion-body">
                                        @inject( "kindObj" , 'App\Repositories\Front\KindRepository' )
                        @php
                            $kindResults = $kindObj->listExpectedBabiesWithCount();
                        @endphp
                          @if( $kindResults['code'] == 200 )
                              @foreach ( $kindResults['result'] as $row)
                                        <div class="form-check">
                                            <input class="form-check-input filter filterKind " data-belongs_to_attribute="Kind" data-filter_column="kindId" id="kind_{{$row->id}}" name="kind" type="radio" value="{{$row->id}}">
                                                <label class="form-check-label" for="kind_{{$row->id}}">
                                                    {{$row->title}}
                                                    <span>
                                                        ( 
                                  @if ( isset( $kindResults['noOfExpectedBabiesArray'][ $row->id ] ) )
                                    {{$kindResults['noOfExpectedBabiesArray'][ $row->id ]}}
                                  @else
                                    0
                                  @endif
                                  )
                                                    </span>
                                                </label>
                                            </input>
                                        </div>
                                        @endforeach
                          @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button aria-controls="flush-collapseTwo" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseTwo" data-bs-toggle="collapse" type="button">
                                        Coming date
                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingTwo" class="accordion-collapse collapse show" id="flush-collapseTwo">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m1" name="comingmonth" type="radio" value="1">
                                                <label class="form-check-label" for="m1">
                                                    {{date('F',strtotime('+1 month'))}}
                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m2" name="comingmonth" type="radio" value="2">
                                                <label class="form-check-label" for="m2">
                                                    {{date('F',strtotime("+2 month"))}}
                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterComingmonth" data-belongs_to_attribute="Month" data-filter_column="comingmonth" id="m3" name="comingmonth" type="radio" value="3">
                                                <label class="form-check-label" for="m3">
                                                    {{date('F',strtotime("+3 month"))}}
                                                </label>
                                            </input>
                                        </div>
                                        <div class="row g-0 range">
                                            <div class="col">
                                                <input class="form-control dateCol" id="minrangetext" placeholder="€" type="date">
                                                </input>
                                            </div>
                                            <div class="col-12 text-center dateCol">
                                                To
                                            </div>
                                        </div>
                                        <div class="row g-0 range">
                                            <div class="col">
                                                <input class="form-control dateCol" id="maxrangetext" placeholder="€" type="date">
                                                </input>
                                            </div>
                                            <div class="col">
                                                <button id="customDate">
                                                    <i class="bi bi-chevron-right">
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button aria-controls="flush-collapseThree" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseThree" data-bs-toggle="collapse" type="button">
                                    {{__('Race')}}
                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingThree" class="accordion-collapse collapse show" id="flush-collapseThree">
                                    <div class="accordion-body">
                                        @inject( "raceObj" , 'App\Repositories\Front\RaceRepository' )
                        @php
                            $raceResults = $raceObj->listExpectedBabiesWithCount();
                        @endphp
                          @if( $raceResults['code'] == 200 )
                              @foreach ( $raceResults['result'] as $row)
                                        <div class="form-check">
                                            <input class="form-check-input filter filterRace" data-belongs_to_attribute="Race" data-filter_column="raceId" id="race_{{$row->id}}" name="race[]" type="checkbox" value="{{$row->id}}">
                                                <label class="form-check-label" for="race_{{$row->id}}">
                                                    {{$row->title}}
                                                    <span>
                                                        ( 
                                  @if ( isset( $raceResults['noOfExpectedBabiesArray'][ $row->id ] ) )
                                    {{$raceResults['noOfExpectedBabiesArray'][ $row->id ]}}
                                  @else
                                    0
                                  @endif
                                  )
                                                    </span>
                                                </label>
                                            </input>
                                        </div>
                                        @endforeach
                          @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button aria-controls="flush-collapseFour" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#flush-collapseFour" data-bs-toggle="collapse" type="button">
                                        Subscription
                                    </button>
                                </h2>
                                <div aria-labelledby="flush-headingFour" class="accordion-collapse collapse show" id="flush-collapseFour">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input filter filterSubscription" data-belongs_to_attribute="Subscription" id="sub" type="checkbox" value="sub">
                                                <label class="form-check-label" for="sub">
                                                    Subscribed
                                                </label>
                                            </input>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter filterSubscription" data-belongs_to_attribute="Subscription" id="unsub" type="checkbox" value="unsub">
                                                <label class="form-check-label" for="unsub">
                                                    Un-Subscribed
                                                </label>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Mobile popup ends here -->
    @endsection
@section('optional_scripts')
    <script src="{{ asset( $publicPath . 'front_assets/js/eblistfilters.js') }}">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
  adListSearchFilter().init("{{route('search_ebListings')}}?query=data&");
});
  $('#filters_menu').on('show.bs.modal', function (e) {
 $('#desktopFilter').remove();
})
    </script>
    <script src="{{ asset( $publicPath . 'front_assets/js/subscribe.js') }}">
    </script>
    @endsection
</link>