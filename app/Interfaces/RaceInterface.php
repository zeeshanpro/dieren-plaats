<?php 
namespace App\Interfaces;
use App\Http\Requests\RaceRequest;
use Illuminate\Http\Request;

interface RaceInterface 
{ 

    /*
    to create the Race 
    @method POST api/race/create
    */
    public function createRace(RaceRequest $request);
    public function listRaces();
    public function update_Race(Request $request);
    public function delete_Race(Request $request);
    public function search( Request $req );
}

?>