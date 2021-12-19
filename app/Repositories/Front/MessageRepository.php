<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\MessageInterface;
use App\Http\Requests\Front\MessageRequest;
use App\Models\Message;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Mail;

class MessageRepository implements MessageInterface
{ 
    public function listMessage(Request $request){
        $userId = Auth::id();

        $allLatestIDs = DB::Select("SELECT max(t1.id) as mainIDsToFetch FROM `messages` as t1 where t1.user_id = ".$userId."  
                         group by ad_id ");
        $idsToPick = array();
        foreach($allLatestIDs as $allLatestID){
            $idsToPick[] = $allLatestID->mainIDsToFetch;
        }

        $adsIds = Ad::where( 'user_id', '=', $userId )
                            ->pluck( 'id' )->toArray();
        if( count( $adsIds ) ){
            $adsIdsStr = implode( ',', $adsIds );                    
            $allLatestIDsFromAds = DB::Select("SELECT max(t1.id) as mainIDsToFetch FROM `messages` as t1 where t1.ad_id in ( ".$adsIdsStr." )
                                 group by ad_id, user_id ");
               
            foreach($allLatestIDsFromAds as $allLatestIDsFromAd){
                $idsToPick[] = $allLatestIDsFromAd->mainIDsToFetch;
            }
        }                    
        
        $data['result'] = Message::whereIn('id', $idsToPick)
                            ->with( [ 'messageAd.adUser' => function($query) {
                                $query->select('id', 'name', 'usertype' );
                            }, 'messageAd.adUser.Breeder', 'messageUser' => function($query) {
                                $query->select('id', 'name', 'usertype' );
                            }, 'messageUser.Breeder' ] )
                            ->orderByDesc('id')->get();
        
        $data['myAds'] = Ad::where( 'user_id', '=', $userId )
                            ->pluck( 'id' )->toArray();
        
        if( isset( $request->adId ) and is_numeric( $request->adId ) ) {    
            $adRecord = Ad::where( 'id', '=', $request->adId )->with('adImages')->first();
            if( $adRecord ){
                $data['adId'] = $request->adId;
                $data['user_id'] = $userId;
                $data['usertype'] = "Buyer";
                $data['adDetail'] = $adRecord;
                $data['otherPerson'] = User::select('id', 'name')
                                    ->where('id', '=', $adRecord->user_id )->with('Breeder')->first();

                $latestMsgs = Message::where( 'ad_id', '=' , $request->adId )
                                    ->where( 'user_id', '=' , $userId );
                if( $latestMsgs->count() > 0 ){
                    $lastMsgRecord = $latestMsgs->orderByDESC('id')->first();
                    $data['oldMsgId'] = $lastMsgRecord->id;
                    $data['dateOfContact'] = $lastMsgRecord->created_at;

                    // $firstMsgRecord = $latestMsgs->orderBy('id')->first();
                    // $data['dateOfContact'] = $firstMsgRecord->created_at;
                    //$data['MsgCount'] = $latestMsgs->count();
                } else {
                    $data['oldMsgId'] = 0;
                    $data['dateOfContact'] = date('Y-m-d H:i:s');
                    //$data['MsgCount'] = 0;
                    //$data['lastMsgId'] = 0;
                }

            }
        }                    

        // dd($data);
        return $data;            
    }

    public function getLatestConversationsWithUser(Request $request, $adId){
        $showData = false;
        $data = array();

        $data['lastMsgId'] = $request->lastMsgId;
        $data['adId'] = $adId;
        $adRecord = Ad::where( 'id', '=', $adId )->with('adImages')->first();
        if( $request->ajax() and $adRecord ){
            $data['adDetail'] = $adRecord;
            
            $userId = Auth::id();
            $ifProceed = Message::where('user_id','=', $userId)
                        ->where( 'ad_id', '=', $adId )
                        ->count();
            if( $ifProceed > 0 ){
                $latestMsgs = Message::where( 'ad_id', '=' , $adId )
                                        ->where( 'user_id', '=' , $userId )
                                        ->where( 'id' , '>' , $request->lastMsgId );
                if( $latestMsgs->count() > 0 ){
                    $data['result'] = $latestMsgs->orderBy('id')->get();
                    $data['newMsgCount'] = $latestMsgs->count();
                } else {
                    $data['newMsgCount'] = 0;
                }
                $data['error'] = false;
                $data['usertype'] = 'Buyer';                
                $this->markAsRead( $adId, $request->lastMsgId );
                return $data;
            } else {
                $myAds = Ad::where( 'user_id', '=', $userId )
                                ->pluck( 'id' )->toArray();
                if( in_array( $adId, $myAds ) ){
                    if( isset( $request->lastMsgId ) and is_numeric( $request->lastMsgId ) ){
                        $userIdToFetch = Message::select('user_id')->where('id', '=', $request->lastMsgId)->first();
                        if( $userIdToFetch ){
                            $latestMsgs = Message::where( 'ad_id', '=' , $adId )
                                                    ->where( 'user_id', '=' , $userIdToFetch->user_id )
                                                    ->where( 'id' , '>' , $request->lastMsgId );
                        
                            if( $latestMsgs->count() > 0 ){
                                $data['result'] = $latestMsgs->orderBy('id')->get();
                                $data['newMsgCount'] = $latestMsgs->count();
                            } else {
                                $data['newMsgCount'] = 0;
                            }
                            $data['error'] = false;
                            $data['usertype'] = 'Seller';
                            $this->markAsRead( $adId, $request->lastMsgId );
                            return $data;
                        }
                    }
                } else {
                    $data['error'] = false;
                    $data['usertype'] = 'Buyer';
                    return $data;
                }                
            }
        }

        $data['newMsgCount'] = 0;
        $data['result'] = [];
        $data['error'] = true;
        $data['msg'] = 'Invalid Call';
        return $data;
    }

    public function getConversationsWithUser(Request $request, $adId){
        $showData = false;
        $data = array();

        $data['lastMsgId'] = $request->lastMsgId;
        $data['adId'] = $adId;
        $adRecord = Ad::where( 'id', '=', $adId )->with('adImages')->first();
        $data['otherPerson'] = User::select('id', 'name')
                                    ->where('id', '=', $adRecord->user_id )->with('Breeder')->first();
        if( $request->lastMsgId == 0 or $request->lastMsgId == '' ) {
            $data['usertype'] = 'Buyer';
        }
        $userId = Auth::id();
        $data[ 'user_id' ] = $userId;

        if( $request->ajax() and $adRecord ){
            $data['adDetail'] = $adRecord;
            
            $ifProceed = Message::where('user_id','=', $userId)
                        ->where( 'ad_id', '=', $adId )
                        ->count();
            if( $ifProceed > 0 ){
                
                $data['result'] = Message::where( 'ad_id', '=' , $adId )
                                        ->where( 'user_id', '=' , $userId )
                                        ->orderBy('id')->get();
                $data['error'] = false;
                $data['usertype'] = 'Buyer';
                $this->markAsRead( $adId, $request->lastMsgId );
                return $data;
            } else {
                $myAds = Ad::where( 'user_id', '=', $userId )
                                ->pluck( 'id' )->toArray();
                if( in_array( $adId, $myAds ) ){
                    if( isset( $request->lastMsgId ) and is_numeric( $request->lastMsgId ) ){
                        $userIdToFetch = Message::select('user_id')->where('id', '=', $request->lastMsgId)->first();
                        if( $userIdToFetch ){
                            $data['result'] = Message::where( 'ad_id', '=' , $adId )
                                                    ->where( 'user_id', '=' , $userIdToFetch->user_id )
                                                    ->orderBy('id')->get();

                            $data['error'] = false;
                            $data['usertype'] = 'Seller';
                            $data[ 'user_id' ] = $userIdToFetch->user_id;
                            $this->markAsRead( $adId, $request->lastMsgId );
                            return $data;
                        }
                    }
                }                
            }
        }
        
        $data['result'] = [];
        $data['error'] = true;
        $data['msg'] = 'Invalid Call';
        return $data;
    }

    public function createMessage( Request $request, $adId ){
        $data = array();
        $validator = Validator::make($request->all(), 
                [ 
                    'msg' => 'required|max:290',
                    'adId' => 'required|numeric',
                    'lastMsgId' => 'required|numeric'
                ]); 

        if ($validator->fails()) { 
            // to review Sunny
            if( $request->is('api/*')){
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();
            }

            $validator->validate();
            return $data;
        }

        if($request->ajax()) {
            DB::beginTransaction();   
            try {
                $adRecordCount = Ad::where( 'id', '=', $adId )->count(); 
                if( $adRecordCount > 0 ){
                    $userId = Auth::id();
                    $ifProceed = Message::where('user_id','=', $userId)
                                        ->where( 'ad_id', '=', $adId )
                                        ->count();
                    if( $ifProceed > 0 ){ // its the buyer who is sending the messages
                        $newMessage = new Message;
                        $newMessage->msg = filter_var( $request->msg , FILTER_SANITIZE_STRING );
                        $newMessage->ad_id = $adId;
                        $newMessage->user_id = $userId;
                        $newMessage->isread = 0;
                        $newMessage->ifsent = 1;
                        $newMessage->save();

                        $data['lastMsgId'] = $newMessage->id;
                        $data['code'] = 201;
                        $data['error'] = false;
                        $data['msg'] = 'Message sent successfully!!';

                        // now prepare to send email to the seller
                        $adRecord = Ad::where( 'id', '=', $adId )->with(['adUser'])->first();
                        $adLink = route( 'ad_detail_page', [ 'adId' => $adRecord->id, 'title' => $adRecord->title ] );
                        $messageBackLink = route( 'messages', [ 'adId' => $adRecord->id ] );
                        
                        $arrayToSend = array('title_of_add' => $adRecord->title, 'seller_name' => $adRecord->adUser->name, 
                                            'link' => $adLink, 'msg' => $newMessage->msg, 'link_to_message_back' => $messageBackLink);
                            Mail::send( 'mailtemplates.seller_received_msg' , $arrayToSend, function( $message ) use( $adRecord ) {
                            $message->to( $adRecord->adUser->email );
                            $message->subject( 'Je hebt een bericht ontvangen' );
                        } );

                        // now send message to buyer himself
                        $user = User::find($userId);
                        unset($arrayToSend);
                        $arrayToSend = array('title_of_add' => $adRecord->title, 'buyer_name' => $user->name, 
                                            'link' => $adLink, 'msg' => $newMessage->msg, 'link_to_message_back' => $messageBackLink);
                            Mail::send( 'mailtemplates.buyer_send_msg_to_seller' , $arrayToSend, function( $message ) use( $user ) {
                            $message->to( $user->email );
                            $message->subject( 'Je bericht is verstuurd' );
                        } );

                    } else {
                        $myAds = Ad::where( 'user_id', '=', $userId )
                                ->pluck( 'id' )->toArray();
                        if( in_array( $adId, $myAds ) ){ // I am seller here and sending message to buyer
                            if( isset( $request->lastMsgId ) and is_numeric( $request->lastMsgId ) ){
                                $userIdToFetch = Message::select('user_id')->where('id', '=', $request->lastMsgId)->first();
                                if( $userIdToFetch ){
                                    $data['result'] = Message::where( 'ad_id', '=' , $adId )
                                                            ->where( 'user_id', '=' , $userIdToFetch->user_id )
                                                            ->orderBy('id')->get();
                                    $newMessage = new Message;
                                    $newMessage->msg = filter_var( $request->msg , FILTER_SANITIZE_STRING );
                                    $newMessage->ad_id = $adId;
                                    $newMessage->user_id = $userIdToFetch->user_id;
                                    $newMessage->isread = 0;
                                    $newMessage->ifsent = 0;
                                    $newMessage->save();

                                    $data['lastMsgId'] = $newMessage->id;
                                    $data['code'] = 201;
                                    $data['error'] = false;
                                    $data['msg'] = 'Message sent successfully!!';

                                    // now prepare to send email to the buyer
                                    $buyerRecord = User::where('id', '=', $userIdToFetch->user_id)->first();
                                    $adRecord = Ad::where( 'id', '=', $adId )->with(['adUser'])->first();
                                    $adLink = route( 'ad_detail_page', [ 'adId' => $adRecord->id, 'title' => $adRecord->title ] );
                                    $messageBackLink = route( 'messages', [ 'adId' => $adRecord->id ] );
                                    
                                    $arrayToSend = array('title_of_add' => $adRecord->title, 'buyer_name' => $buyerRecord->name, 
                                                        'link' => $adLink, 'msg' => $newMessage->msg, 'link_to_message_back' => $messageBackLink);
                                        Mail::send( 'mailtemplates.buyer_receive_msg' , $arrayToSend, function( $message ) use( $buyerRecord ) {
                                        $message->to( $buyerRecord->email );
                                        $message->subject( 'Je hebt een bericht ontvangen' );
                                    } );
                                }
                            }
                        } else {
                            $newMessage = new Message;
                            $newMessage->msg = filter_var( $request->msg , FILTER_SANITIZE_STRING );
                            $newMessage->ad_id = $adId;
                            $newMessage->user_id = $userId;
                            $newMessage->isread = 0;
                            $newMessage->ifsent = 1;
                            $newMessage->save();
    
                            $data['lastMsgId'] = $newMessage->id;
                            $data['code'] = 201;
                            $data['error'] = false;
                            $data['msg'] = 'Message sent successfully!!';

                            // now prepare to send email to the seller
                            $adRecord = Ad::where( 'id', '=', $adId )->with(['adUser'])->first();
                            $adLink = route( 'ad_detail_page', [ 'adId' => $adRecord->id, 'title' => $adRecord->title ] );
                            $messageBackLink = route( 'messages', [ 'adId' => $adRecord->id ] );
                            
                            $arrayToSend = array('title_of_add' => $adRecord->title, 'seller_name' => $adRecord->adUser->name, 
                                                'link' => $adLink, 'msg' => $newMessage->msg, 'link_to_message_back' => $messageBackLink);
                                Mail::send( 'mailtemplates.seller_received_msg' , $arrayToSend, function( $message ) use( $adRecord ) {
                                $message->to( $adRecord->adUser->email );
                                $message->subject( 'Je hebt een bericht ontvangen' );
                            } );

                            // now send message to buyer himself
                            $user = User::find($userId);
                            unset($arrayToSend);
                            $arrayToSend = array('title_of_add' => $adRecord->title, 'buyer_name' => $user->name, 
                                                'link' => $adLink, 'msg' => $newMessage->msg, 'link_to_message_back' => $messageBackLink);
                                Mail::send( 'mailtemplates.buyer_send_msg_to_seller' , $arrayToSend, function( $message ) use( $user ) {
                                $message->to( $user->email );
                                $message->subject( 'Je bericht is verstuurd' );
                            } );
                        }

                        
                    } 
                } else {
                    $data['code'] = 201;
                    $data['error'] = false;
                    $data['msg'] = 'Sorry!! Due to Technical issue message could not be sent. Please refresh the page and try again!!';
                }
                    
                DB::commit();
                $this->markAsRead( $adId, $newMessage->id );
                return $data;
    
            } catch(\Exception $e) {
                DB::rollBack();
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $e->getMessage();
                return $data;
            }
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Invalid call';
            return $data;
        }
    } 

    public function markAsRead( $adId, $lastMsgId ){
        DB::beginTransaction();   
        try {
            $userId = Auth::id();
            $ifProceed = Message::where('user_id','=', $userId)
                            ->where( 'ad_id', '=', $adId )
                            ->count();
            if( $ifProceed > 0 ){
                $updateMsg = Message::where( 'ad_id', '=', $adId )
                                    ->where( 'user_id', '=',  $userId )
                                    ->where( 'ifsent' , '=', 0 )
                                    ->update( ['isread' => 1] );
            } else {
                $myAds = Ad::where( 'user_id', '=', $userId )
                            ->pluck( 'id' )->toArray();
                if( in_array( $adId, $myAds ) ){ // I am seller and now lets mark the messages as read
                    $userIdToFetch = Message::select('user_id')->where('id', '=', $lastMsgId)->first();
                    if( $userIdToFetch ){
                        $updateMsg = Message::where( 'ad_id', '=', $adId )
                                            ->where( 'user_id', '=',  $userIdToFetch->user_id )
                                            ->where( 'ifsent' , '=', 1 )
                                            ->update( ['isread' => 1] );
                    }
                }
            }
            DB::commit();
            $data['error'] = false;
            $data['msg'] = 'operation successful';
            return $data;
        }     
        catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }       
    }

    public function getUnreadMsgCount(){
        $data = array();
        $data['unReadConversations'] = 0;
        $data['totalUnReadConversations'] = 0;
        $userId = Auth::id();
        if( $userId > 0 ){
            $totalUnreadMsgs = 0 ;
            $unReadConversations = 0;

            $allLatestIDs = DB::Select("SELECT max(t1.id) as mainIDsToFetch, count( t1.id ) as countOfMsgs FROM `messages` as t1 where t1.user_id = ".$userId."  
                         and t1.isread = '0' and t1.ifsent = '0' group by ad_id ");
            $idsToPick = array();
            foreach($allLatestIDs as $allLatestID){
                $unReadConversations++;
                $totalUnreadMsgs += $allLatestID->countOfMsgs;
            }

            $adsIds = Ad::where( 'user_id', '=', $userId )
                                ->pluck( 'id' )->toArray();
            if( count( $adsIds ) ){
                $adsIdsStr = implode( ',', $adsIds );                    
                $allLatestIDsFromAds = DB::Select("SELECT max(t1.id) as mainIDsToFetch, count( t1.id ) as countOfMsgs FROM `messages` as t1 where t1.ad_id in ( ".$adsIdsStr." )
                                    and t1.isread = '0' and t1.ifsent = '1' group by ad_id, user_id ");
                
                foreach($allLatestIDsFromAds as $allLatestIDsFromAd){
                    $unReadConversations++;
                    $totalUnreadMsgs += $allLatestIDsFromAd->countOfMsgs;
                }
            } 
            
            $data['unReadConversations'] = $unReadConversations;
            $data['totalUnReadConversations'] = $totalUnreadMsgs;

        }
        return $data;
    }

    public function deleteConversation( Request $request ){
        
        $adId = $request->adId;
        $lastMsgId = $request->lastMsgId;

        DB::beginTransaction();   
        try {
            $userId = Auth::id();
            $ifProceed = Message::where('user_id','=', $userId)
                            ->where( 'ad_id', '=', $adId )
                            ->count();
            if( $ifProceed > 0 ){
                $deleteMsg = Message::where( 'ad_id', '=', $adId )
                                    ->where( 'user_id', '=',  $userId )
                                    ->delete();
            } else {
                $myAds = Ad::where( 'user_id', '=', $userId )
                            ->where('id', '=', $adId)
                            ->count();
                if( $myAds == 1 ){ // I am seller and now lets mark the messages as read
                    $userIdToFetch = Message::select('user_id')->where('id', '=', $lastMsgId)->first();
                    if( $userIdToFetch ){
                        $deleteMsg = Message::where( 'ad_id', '=', $adId )
                                            ->where( 'user_id', '=',  $userIdToFetch->user_id )
                                            ->delete();
                    }
                }
            }
            DB::commit();
            $data['error'] = false;
            $data['msg'] = 'deleted successfully';
            return $data;
        }     
        catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }    
    }
}

