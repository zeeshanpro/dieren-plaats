<div class="expected_panel">
    <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5">
              <h2>{{__('Expected Babies')}}</h2>
          </div>
        </div>
        <div class="row justify-content-center">
            @inject( "expectedRepoObj" , 'App\Repositories\Front\ExpectedBabieRepository' )
            @php
                $expectedRows = $expectedRepoObj->list_expected_babie( 4 );
            @endphp
                @if( $expectedRows['code'] == 200 )
                    @foreach ( $expectedRows['result'] as $row)
                        @include( 'front.layout.components.subviews.expecedBabiesCell', [ 'row' => $row,'subscribedBabies'=> $expectedRows['subscribedBabies'] ] )
                    @endforeach
                @endif    
        </div>
    </div>
</div> 