<?php 
namespace App\Interfaces;
use App\Http\Requests\AdAttributeRequest;
use Illuminate\Http\Request;

interface AdAttributeInterface 
{ 

    /*
    to create the Ad_attribute 
    @method POST api/ad_attribute/create
    */
    public function createAdAttribute(AdAttributeRequest $request);
    public function listAttributes(); 
    public function add_options( Request $request );
    public function delete_options( Request $request );
    public function update_option( Request $request );
    public function delete_attribute( Request $request );
    public function update_attribute( Request $request );
}

?>