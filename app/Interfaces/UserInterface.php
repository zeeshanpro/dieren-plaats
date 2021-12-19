<?php 
namespace App\Interfaces;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
interface UserInterface 
{ 

    /*
    to create the User 
    @method POST api/user/create
    */
    public function createUser(UserRequest $request);
    public function listUsers(); 
    public function searchUsers(Request $request); 
    public function viewUser( $userId ); 
    public function update(Request $request); 
}

?>