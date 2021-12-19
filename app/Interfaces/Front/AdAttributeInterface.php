<?php 
namespace App\Interfaces\Front;
use App\Http\Requests\AdAttributeRequest;
use Illuminate\Http\Request;

interface AdAttributeInterface 
{ 

    /*
    to create the Ad_attribute 
    @method POST api/ad_attribute/create
    */
    public function listAttributes(); 
}

