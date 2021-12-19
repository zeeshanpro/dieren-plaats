<section style="display:contents;" id="adDataContainer">
    <div class="row justify-content-center">
            <?php 
            
        if( isset( $savedAdsIds ) )
            $adids = explode(',', $savedAdsIds);
        else
            $adids = array();
            ?>
            
            @forelse ( $result as $row)
            <?php 
            $idExist = in_array($row->id , $adids); 
            ?>
                @include( 'front.layout.components.subviews.adCell', [ 'topAdsArray' => $topAdsArray, 'row' => $row , 'ifWatchLater'=>$idExist,'cellColumn' => 4] )
                @empty
                <h3 class="border rounded m-2 p-4 w-75">{{__('No Data Available')}}</h3>
            @endforelse


        </div>
        <!-- CONTENT BOTTOM PANEL-->
        <div class="row mt-4 mb-4">
        <div class="col-auto me-auto">
            {{ $result->links('pagination::bootstrap-4') }}
        </div>
        </div>
</section>