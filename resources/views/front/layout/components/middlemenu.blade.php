
@inject( "kindMaster" , 'App\Repositories\Front\KindRepository' )
@php
    if( isset( $hideViewAll ) )
        $showNos = 50;
    else 
        $showNos = 7;

    $kindResults = $kindMaster->list( $showNos );
@endphp
  @if ( $iconstyle ?? false )
  <div class="search_by_type_panel">
      <div class="container">
          <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h5>{{__('Type of pets')}}</h5>
                <h2>{{__('Search by type')}}</h2>
            </div>
          </div>
          <div class="row">
                <div class="float_icon" style="margin-left:-58px;"><img src="{{ asset( $publicPath . 'front_assets/images/dog.svg') }}"/></div>
                @foreach ( $kindResults['result'] as $row)
                <div class="col-6 col-md-3">
                    <a href="{{route( 'listads_byslug', [ 'kindSlug' => $row->title_slug ] )}}">
                    <div class="type_box">
                        <img style="width:104;height:104px;" src="{{ url('storage/app/public/uploads/kindicon/thumb/'.($row->icon ?? 'default.png')) }}">
                        <h3>{{ $row->title }}</h3>
                    </div>
                    </a>  
                </div>
                @endforeach

            @if ( !isset($hideViewAll) )
              <div class="col-6 col-md-3">
                <a href="#">
                <div class="type_box">
                    <a href="{{url('allkinds')}}">
                    <img src="{{ asset( $publicPath . 'front_assets/images/type8.svg') }}">
                    <h3>{{__('View all')}}</h3>
                    </a>
                </div>
                </a>
                <div class="float_icon" style="right:-70px;"><img src="{{asset('/front_assets/images/cat.svg')}}"/></div>
              </div>
            @endif

          </div>
      </div>
  </div> 
  @elseif(!isset($mobileMenu) && !isset($iconstyle))
        <div class="middle_bar d-none d-md-block">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <ul>
                        @if( $kindResults['code'] == 200 )
                            @foreach ( $kindResults['result'] as $row)
                                <li class="{{ request()->is('adlistings/'.$row->title_slug ) ? 'underline' : '' }}"><a href="{{route( 'listads_byslug', [ 'kindSlug' => $row->title_slug ] )}}">{{ $row->title }}</a></li>
                            @endforeach
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
  @endif

  @if ( $mobileMenu ?? false )
 @if( $kindResults['code'] == 200 )
                            @foreach ( $kindResults['result'] as $row)
                            <a class="nav-link {{ request()->is('adlistings/'.$row->title_slug ) ? 'active ' : '' }}" href="{{route( 'listads_byslug', [ 'kindSlug' => $row->title_slug ] )}}" {{ request()->is('adlistings/'.$row->title_slug ) ? 'aria-current="page" ' : '' }}>{{ $row->title }}</a>
                                
                            @endforeach
                        @endif

  @endif
  
  
  