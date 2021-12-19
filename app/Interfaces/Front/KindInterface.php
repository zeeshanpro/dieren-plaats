<?php 
namespace App\Interfaces\Front;
use Illuminate\Http\Request;

interface KindInterface 
{ 
    /*
    to create the Kind 
    @method POST api/kind/create
    */
    public function list();
    public function search( Request $req );
}
