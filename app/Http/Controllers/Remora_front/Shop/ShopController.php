<?php

namespace App\Http\Controllers\Remora_front\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\AdInterface;
use App\Interfaces\Front\UserInterface;
use App\Http\Requests\Front\AdRequest;
use App\Http\Requests\Front\UpdateAdRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use App\Models\AdView;
use App\Models\User;
use App\Models\Kind;
use App\Models\Race;
use App\Models\BreederReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe;
use Session;
use Exception;
use Mail;

class ShopController extends Controller
{
    protected $adInterface;
    protected $userInterface;
    public function __construct(AdInterface $adInterface, UserInterface $userInterface)
    {
        $this->adInterface = $adInterface;
        $this->userInterface = $userInterface;
    }

    public function index(Request $request){
        if( $request->category != '' ){
            $kindObj = Kind::where('title_slug', '=', $request->category);
            if( $kindObj->count() > 0 ){
                $kindRec = $kindObj->first();
                $request->merge(["kindId"=>$kindRec->id]); 
            } else {
                return redirect()->route('base_url');;
            }
        }

        if( $request->subcategory != ''){
            $raceObj = Race::where('title_slug', '=', $request->subcategory);
            if( $raceObj->count() > 0 ){
                $raceRec = $raceObj->first();
                $request->merge(["options_race"=>$raceRec->id]); 
            } else {
                return redirect()->route('base_url');;
            }
        }

        $data = $this->adInterface->listAdsWithPaginateAndSearch( $request );
        if( $data['code'] == 422 ){
            return redirect()->route('base_url');
        }

        if( isset($request->options_race) and is_numeric( $request->options_race ) ){
            $data['options_race'] = $request->options_race;
        }
        
        return view('front_new.shop', $data);
    }
 
}