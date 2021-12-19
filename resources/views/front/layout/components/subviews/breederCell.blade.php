
<div class="{{ isset($wideStyle) ? 'col-lg-4' : 'col-lg-3' }} col-md-5">
                <!-- IMAGE BOX -->
    <div class="image_box type_3 {{ isset($wideStyle) ? 'mb-4' : '' }}">
        <div class="info">
            <div class="row">
                <div class="col col-md-4 left-side">
                   <a href="{{ url('/profile/'.$row->id.'/'.Str::slug($row->breeder->owner_name)) }}"> 
                    @if(isset($row->breeder->logo) && $row->breeder->logo)
                    <img src="{{url('storage/app/public/uploads/users/thumb/' . $row->breeder->logo ?? '')}}" alt="No Image" />
                    @else
                    <img src="{{asset('front_assets/images/default.jpg')}}" alt="No Image" />
                    @endif

                   </a>
                      <ul class="detail_list" style="margin: 12px 22px;">
                        
                        <li><label>Ads</label>{{$row->user_ads_count}}</li>
                    </ul>
                </div>
                <div class="col-8 col-md-8">
                    <div class="name" title="{{$row->breeder->company_name ? $row->breeder->company_name : $row->breeder->owner_name??'No Name' }}">
                        <a href="{{ url('/profile/'.$row->id.'/'.Str::slug($row->breeder->owner_name)) }}"> 
                    {{Str::ucfirst($row->breeder->company_name ? Str::limit($row->breeder->company_name, 10, '...') : Str::limit($row->breeder->owner_name, 10, '...')??'No Name') }}
                </a>
                    </div>
                    <div class="reviews">
                    @include( 'front.layout.components.stars',['stars'=> ($row->breeder->avgRating[0]->aggregate ?? '0') ] )
                    </div>
                    <ul class="detail_list">
                        <li><label>Type</label> {{$row->breeder->breederKinds[0]->breeder_kindKind->title ?? 'niet vermeld' }}</li>
                        <li><label>Breed</label>{{$row->breeder->breederKinds[0]->breeder_kindRace->title ?? 'niet vermeld' }}
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>  
    </div>
</div>