<?php 
namespace App\Interfaces;
use App\Http\Requests\ExpectedBabieRequest;
use Illuminate\Http\Request;

interface ExpectedBabieInterface 
{ 

    /*
    to create the Expected_babie 
    @method POST api/expected_babie/create
    */
    public function create_expected_babie( ExpectedBabieRequest $request );
    public function list_expected_babie( );
    public function search_expected_babie( Request $request );
    public function view( Request $request );
    public function update( Request $request );
}

?>