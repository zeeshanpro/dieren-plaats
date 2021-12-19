<section style="display:contents;" id="breederDataContainer">
<div class="col-md-9 mt-3" >
                <div class="row">
                 
                @if( $code == 200 )
                    @forelse ( $result as $row)
                        @include( 'front.layout.components.subviews.breederCell', [ 'row' => $row , 'wideStyle' => true ] )
                        @empty
                        <h3 class="border rounded p-4 w-75 m-2">No Breeder Available In This Search.</h3>
                    @endforelse
                @endif
                
                </div>
            </div>
            <div class="col-md-1 pt-5">
                  <img src="{{asset('front_assets/images/advertisement.svg')}}" />
              </div>
              </div> <!-- end of row in inner_page_content_area -->
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                  {{ $result->links('pagination::bootstrap-4') }}

                     
                  </div>
                
              </div>
</section>