<?php 
namespace App\Interfaces\Front;
use Illuminate\Http\Request;
use App\Http\Requests\Front\ExpectedBabieRequest;

interface ExpectedBabieInterface 
{ 

    /*
    to create the User 
    @method POST api/user/create
    */
    public function create_expected_babie( Request $request );
    public function list_expected_babie( );
    public function search_expected_babie( Request $request );
    public function view( Request $request );
    public function update( Request $request );
    public function subscribe( Request $request );
    public function showExpectedBabiesOfProfile( $userId );
}

?>