<?php 
namespace App\Repositories\Front;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Front\KindInterface;
use App\Models\Kind;

class KindRepository implements KindInterface
{
    public function list( $limit = 7 ){
        $data['result'] = Kind::where('status', '=', 1)->orderBy('title', 'ASC')
                                ->limit($limit)->get();
        $data['code'] = 200;
        //dd($data['result']);
        return $data;
    }

    public function listWithCount(){
        $data['result'] = Kind::where('status', '=', 1)
                                ->orderBy('title', 'ASC')
                                 ->get();
        $kindCountsRows = Kind::join('breeder_kinds', 'kinds.id', '=', 'breeder_kinds.kind_id')
                        ->join('breeders', 'breeder_kinds.breeder_id', '=', 'breeders.id')
                        ->join('users', 'breeders.user_id', '=', 'users.id')
                        ->selectRaw('kinds.id, count(breeder_kinds.breeder_id) as noOfBreeders')
                        ->where('users.usertype', '=', 'Breeder')
                        ->groupBy( 'kinds.id' )
                        ->get()->toArray();

        $noOfBreedersArray = array();
        foreach( $kindCountsRows as $kindCountsRow ){
            $noOfBreedersArray[ $kindCountsRow['id'] ] = $kindCountsRow['noOfBreeders'];
        }
        $data['noOfBreedersArray'] = $noOfBreedersArray;
        $data['code'] = 200;
        return $data;
    }

    public function listWithCountAllUsers(){
        $data['result'] = Kind::where('status', '=', 1)
                                ->withCount('kindAds')
                                ->orderBy('title', 'ASC')
                                 ->get();
        $data['code'] = 200;
        return $data;
    }

    public function listExpectedBabiesWithCount(){
        $data['result'] = Kind::where('status', '=', 1)
                                ->orderBy('title', 'ASC')
                                 ->get();
        $kindCountsRows = Kind::join('expected_babies', 'kinds.id', '=', 'expected_babies.kind_id')
                        ->selectRaw('kinds.id, count(expected_babies.kind_id) as noOfExpectedBabies')
                        ->groupBy( 'kinds.id' )
                        ->get()->toArray();

        $noOfBreedersArray = array();
        foreach( $kindCountsRows as $kindCountsRow ){
            $noOfBreedersArray[ $kindCountsRow['id'] ] = $kindCountsRow['noOfExpectedBabies'];
        }
        $data['noOfExpectedBabiesArray'] = $noOfBreedersArray;
        $data['code'] = 200;
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
            $data['result'] = Kind::where('status', '=', 1)
                                            ->where('title', 'like', '%'.$query.'%')
                                            ->withCount(['kindBreederKinds','kindExpectedBabies', 'kindAds'])
                                            ->paginate(REC_PER_PAGE);
            
            $data['code'] = 200; 
            return $data;
        }
    }

    public function getAllKindsAndRaces(){
        $allKindAndRaces = Kind::where('status', '=', 1)
                            ->with([ 'races' => function ( $query ) {
                                $query->where( 'status', '=', 1 );
                            } ] )->get();
        return $allKindAndRaces;
    }
    
}
