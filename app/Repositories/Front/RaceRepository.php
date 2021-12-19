<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\RaceInterface;
use App\Models\Race;

class RaceRepository implements RaceInterface
{
    public function list( $limit = 7 ){
        $data['result'] = Race::where('status', '=', 1)
                                ->orderBy('title', 'ASC')
                                ->limit($limit)->get();
        $data['code'] = 200;
        //dd($data['result']);
        return $data;
    }

    public function listByKind( $kindId = 0 ){
        $data['result'] = Race::where('status', '=', 1)
                                ->where('kind_id', '=', $kindId)
                                ->orderBy('title', 'ASC')
                                ->get();
        $data['code'] = 200;
        //dd($data['result']);
        return $data;
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output = "";
            $data['result'] = Race::where('status', '=', 1)
                                            ->where('title', 'like', '%'.$query.'%')
                                            ->paginate(REC_PER_PAGE);
            
            $data['code'] = 200; 
            return $data;
        }
    }

    public function listExpectedBabiesWithCount(){
        $data['result'] = Race::where('status', '=', 1)
                                ->orderBy('title', 'ASC')
                                 ->get();
        $raceCountsRows = Race::join('expected_babies', 'races.id', '=', 'expected_babies.race_id')
                        ->selectRaw('races.id, count(expected_babies.race_id) as noOfExpectedBabies')
                        ->groupBy( 'races.id' )
                        ->get()->toArray();

        $noOfExpectedBabiesArray = array();
        foreach( $raceCountsRows as $raceCountsRow ){
            $noOfExpectedBabiesArray[ $raceCountsRow['id'] ] = $raceCountsRow['noOfExpectedBabies'];
        }
        $data['noOfExpectedBabiesArray'] = $noOfExpectedBabiesArray;
        $data['code'] = 200;
        return $data;
    }

}
