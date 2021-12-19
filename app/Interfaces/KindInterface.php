<?php 
namespace App\Interfaces;
use App\Http\Requests\KindRequest;
use Illuminate\Http\Request;

interface KindInterface 
{ 

    /*
    to create the Kind 
    @method POST api/kind/create
    */
    public function createKind(KindRequest $request);
    public function listKinds();
    public function update_Kind(Request $request);
    public function delete_Kind(Request $request);
    public function search( Request $req );
}
