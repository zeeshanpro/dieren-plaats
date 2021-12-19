<?php

namespace App\Http\Controllers\Front\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\MessageInterface;
use App\Http\Requests\Front\MessageRequest;

class MessageController extends Controller
{
    
    protected $messageInterface;
    public function __construct(MessageInterface $messageInterface)
    {
        $this->messageInterface = $messageInterface;
    }

    public function create(Request $request){
        if( isset( $request->adId ) and is_numeric( $request->adId ) ){
            return $result = $this->messageInterface->createMessage( $request, $request->adId );
        } else {
            return 'Invalid Call';
        }
    } 
    
    public function getLatest(Request $request){
        if( isset( $request->adId ) and is_numeric( $request->adId ) ){
            return $result = $this->messageInterface->getLatestConversationsWithUser( $request, $request->adId );
        } else {
            return 'Invalid Call';
        }
    }

    public function listMessages( Request $request ){
        $result = $this->messageInterface->listMessage( $request );
        return view( 'front.userpanel.messages' , $result );
    }

    public function getConversationsWithUser( Request $request ){
        if( isset( $request->adId ) and is_numeric( $request->adId ) ){
            $result = $this->messageInterface->getConversationsWithUser( $request, $request->adId );
            return view('front.layout.components.messageList', $result)->render();
        } else {
            return 'Invalid Call';
        }
    }

    public function deleteConversation( Request $request ){
        if( isset( $request->adId ) and is_numeric( $request->adId ) and isset( $request->lastMsgId ) and is_numeric( $request->lastMsgId ) ){
            return $result = $this->messageInterface->deleteConversation( $request );
        } else {
            return 'Invalid Call';
        }
    }
    
}
