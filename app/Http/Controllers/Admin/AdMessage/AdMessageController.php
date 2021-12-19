<?php

namespace App\Http\Controllers\Admin\AdMessage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class AdMessageController extends Controller
{
    public function get_msgs( Request $request ){
        $data = array();
        $userId = $request->get( 'userid' );
        $adId = $request->get( 'adid' );

        $ifProceed = Message::where('user_id','=', $userId)
                        ->where( 'ad_id', '=', $adId )
                        ->count();
        if( $ifProceed > 0 ){
            $data['result'] = Message::where( 'ad_id', '=' , $adId )
                                    ->where( 'user_id', '=' , $userId )
                                    ->with([ 'messageUser.Breeder', 'messageAd.adUser.Breeder' ])
                                    ->orderBy('id')->get();
            $data['error'] = false;
        } else {
            $data['result'] = array();
            $data['error'] = true;
            $data['msg'] = 'No msgs in the chat';
        }
        
        return view('admin.layouts.component.chatdata', $data)->render();
    }
}
