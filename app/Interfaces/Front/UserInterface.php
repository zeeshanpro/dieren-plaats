<?php 
namespace App\Interfaces\Front;
use App\Http\Requests\Front\UserRequest;
use Illuminate\Http\Request;
interface UserInterface 
{ 

    /*
    to create the User 
    @method POST api/user/create
    */
    public function getBreeders( $limit );
    public function createUser(UserRequest $request);
    public function searchUsers(Request $request); 
    public function viewUser( $userId ); 
    public function updateUser(Request $request); 
    public function loginUserManual(Request $request); 
    public function validateEmailVerification( Request $request );
    public function saveforlater( Request $request );
    public function update_logindetails( Request $request );
    public function completeRegistration(Request $request);
}

?>