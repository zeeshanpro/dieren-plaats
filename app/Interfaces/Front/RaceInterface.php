<?php 
namespace App\Interfaces\Front;
use Illuminate\Http\Request;

interface RaceInterface 
{ 
    /*
    to create the Kind 
    @method POST api/kind/create
    */
    public function list();
    public function search( Request $req );
    public function listByKind( $kindId );
}