<?php 
namespace App\Http\Controllers\Admin\Race;
use App\Http\Controllers\Controller;
use App\Interfaces\RaceInterface;
use App\Http\Requests\RaceRequest;
use Illuminate\Http\Request;

class RaceController extends Controller
{ 
    protected $raceInterface;
    public function __construct(RaceInterface $raceInterface)
    {
        $this->raceInterface = $raceInterface;
    }

    public function create(RaceRequest $request){
        return $this->raceInterface->createRace( $request );
    } 

    public function update(Request $request){
        return $this->raceInterface->update_Race( $request );
    } 
    
    public function delete(Request $request){
        return $this->raceInterface->delete_Race( $request );
    } 
    
    public function list(){
        $data = $this->raceInterface->listRaces();
        return view('admin.settings.race', $data);
    } 

    public function search( Request $req ){
        $data = $this->raceInterface->search($req);
        return view('admin.settings.race_table_data',$data)->render();
    }

}

?>