<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\AdAttributeInterface;
use App\Models\AdAttribute;
use App\Models\Kind;
use App\Models\Ad;
use App\Models\Race;
use App\Models\AdAttributeOption;
use App\Models\AdSelectedAttribute;

class AdAttributeRepository implements AdAttributeInterface
{ 

    public function listAttributes( $kindId = 0 ){
        
        $data['result'] = AdAttribute::where( 'status', '=' , 1 )
                            ->where( function($query) use( $kindId ) {
                                if( $kindId > 0 ){
                                    $query->where( 'kind_id', '=', $kindId );
                                }
                            } )
                            ->with(['ad_attributeAdAttributeOptions' => function($q) {
                                $q->where('status','=',1);
                            }] )->get();                               
        
        $data['race'] = Race::where( 'status', '=', 1 )
                            ->where( function( $query ) use ( $kindId ) {
                                if( $kindId > 0 ){
                                    $query->where( 'kind_id', '=', $kindId );
                                }
                            } )
                            ->withCount(['raceAds' => function($query) {
                                $query->where('status', '=', 1);
                            }])
                            ->orderBy('title', 'ASC')->get();

                            

        $adObj = Ad::where('expires_on', '>=', date('Y-m-d'))
                    ->where( 'status', '=', 1 )
                    ->where('kind_id', '=' , $kindId );

        $adRec = array();
        if( $adObj->count() > 0 ){
            $adRec = $adObj->pluck( 'id' )->toArray();
        }                    

        $adsCountPerOptions = AdSelectedAttribute::select( 'ad_attribute_option_id', DB::raw('count(*) as total') )
                                        ->whereIn( 'ad_id', $adRec )
                                        ->groupBy('ad_attribute_option_id')
                                        ->get();
        $arrayOfCountByOptions = array();                                
        foreach( $adsCountPerOptions as $adsCountPerOption ){
            $arrayOfCountByOptions[ $adsCountPerOption->ad_attribute_option_id ] = $adsCountPerOption->total;
        } 

        $data['arrayOfCountByOptions'] = $arrayOfCountByOptions;
        $data['code'] = 200;
        
        return $data;
    }
}