<?php 
namespace App\Interfaces\Front;
use App\Http\Requests\Front\MessageRequest;
use Illuminate\Http\Request;

interface MessageInterface 
{ 

    /*
    to create the Message 
    @method POST api/message/create
    */
    public function createMessage(Request $request, $adId );
    public function listMessage(Request $request);
    public function getConversationsWithUser(Request $request, $adId); 
    public function getLatestConversationsWithUser(Request $request, $adId);
    public function markAsRead( $adId, $lastMsgId );
    public function deleteConversation( Request $request );
}

?>