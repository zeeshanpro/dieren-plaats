<div class="breeders_panel">
    <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5">
              <h2>{{__('Breeders')}}</h2>
          </div>
        </div>
        <div class="row justify-content-center">
            @inject( "breederObj" , 'App\Repositories\Front\UserRepository' )
            @php
                $breederRows = $breederObj->getBreeders( 4 );
            @endphp
                @if( $breederRows['code'] == 200 )
                    @foreach ( $breederRows['result'] as $row)
                        @include( 'front.layout.components.subviews.breederCell', [ 'row' => $row ] )
                    @endforeach
                @endif
        </div>
    </div>
  </div> 