<?php

namespace App\Http\Controllers\Front\AdAttributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Race;
use App\Models\AdSelectedAttribute;
use Illuminate\Support\Facades\Auth;

class AdAttributesController extends Controller
{
    public function showattributespage( Request $request ){
        $adData['adData'] = Ad::where( [ 
                                [ 'id' , '=', $request->adId ],
                                [ 'user_id' , '=', Auth::user()->id ]
                            ])
                      ->with(['adImages','adKind','adRace'])
                      ->first();

        $selectedAttributes = AdSelectedAttribute::where( 'ad_id', '=', $request->adId )->pluck( 'ad_attribute_option_id' )->toArray();              

        if( $adData ){
            return view('front.ad.createad_showattributes', [ 'adData' => $adData['adData'], 'selectedAttributes' => $selectedAttributes ]);
        } else {
            return redirect('/');
        }
    }

    public function get_races_by_kind( Request $request ){
        $raceRows = array();
        if( $request->ajax() ) {
            if( is_numeric( $request->kindId ) ){
                $raceRows = Race::where( 'kind_id', '=', $request->kindId )->get();
                return json_encode($raceRows);
            } else {
                return json_encode($raceRows);
            }
        } else {
            return json_encode($raceRows);
        }
    }
}
