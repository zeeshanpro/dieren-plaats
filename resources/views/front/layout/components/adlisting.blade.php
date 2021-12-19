<div class="highlighted_panel">
    <div class="container">
        <div class="row ">
          <div class="col-md-12 text-center mb-5">
              <h2>{{__('Highlighted')}}</h2>
          </div>
        </div>
        <div class="row justify-content-center">
            @inject( "adMaster" , 'App\Repositories\Front\AdRepository' )
            @php
                $adResults = $adMaster->listAds( 8 );
            @endphp
                @if( $adResults['code'] == 200 )
                <?php 
                if( isset( $adResults['savedAdsIds'] ) )
                    $adids = explode(',', $adResults['savedAdsIds']);
                else
                    $adids = array();
                    ?>
                    @foreach ( $adResults['result'] as $row)
                    <?php 
                    $idExist = in_array($row->id , $adids); 
                    ?>
                        @include( 'front.layout.components.subviews.adCell', [ 'topAdsArray' => $adResults['topAdsArray'], 'row' => $row , 'ifWatchLater'=>$idExist] )
                    @endforeach
                @endif
        </div>
    </div>
  </div> 