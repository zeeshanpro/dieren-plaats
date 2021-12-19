<?php 
namespace App\Repositories;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\RaceInterface;
use App\Http\Requests\RaceRequest;
use App\Models\Race;
use App\Models\Kind;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RaceRepository implements RaceInterface
{ 
    public function listRaces(){
        $data['result'] = Race::where('status', '=' , 1)
                            ->withCount(['raceAds','raceExpectedBabies','kind'])->paginate(REC_PER_PAGE);
        $data['kinds'] = Kind::where('status', '=', 1)->orderBy('title', 'ASC')->get();
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
            $data['result'] = Race::where('status', '=', 1)
                                            ->where('title', 'like', '%'.$query.'%')
                                            ->withCount(['raceAds','raceExpectedBabies'])
                                            ->paginate(REC_PER_PAGE);
            
            $data['code'] = 200; 
            return $data;
        }
    }

    public function update_Race( Request $req ){
        $validator = Validator::make($req->all(), 
                [ 
                    'kindid' => 'required|numeric',
                    'raceid' => 'required', 
                    'title' => 'required'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }
        
        if( Race::find($req->raceid)->exists() ) {
            // set the status to 0 if exists
            $titleSlug = Str::slug($request->title);
            $raceObj = Race::where( 'title_slug', '=', $titleSlug )->where( 'id', '!=', $req->raceid );
            if( $raceObj->count() > 0 ){
                $counter = 1;
                do {  
                    $testSlug = $titleSlug . '-'.$counter;
                    $raceObj = Race::where( 'title_slug', '=', $testSlug );
                } while( $raceObj->count() > 0 );
                $titleSlug = $testSlug;
            }  
            
            $raceRecord = Race::find($req->raceid);
            $raceRecord->title = ucwords($req->title);
            $raceRecord->title_slug = $titleSlug;
            $raceRecord->kind_id = $req->kindid;
            $raceRecord->update();
                            //->update([ 'title' => ucwords($req->title), 'kind_id' => $req->kindid ]);
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'This Race does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Race Saved Successfully';
        return $data;
    } 

    public function delete_Race( Request $req ){
        $validator = Validator::make($req->all(), 
                [ 
                    'raceid' => 'required'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }
        
        if( Race::where('id', '=', $req->raceid)->exists() ) {
            // set the status to 0 if exists
            Race::where('id', '=', $req->raceid)
                            ->update([ 'status' => 0 ]);
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'This Race does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Race Removed Successfully';
        return $data;
    } 

    public function createRace( RaceRequest $request ){
        
        DB::beginTransaction();   
        try { 
                $titleSlug = Str::slug($request->title);
                $raceObj = Race::where( 'title_slug', '=', $titleSlug );
                if( $raceObj->count() > 0 ){
                    $counter = 1;
                    do {  
                        $testSlug = $titleSlug . '-'.$counter;
                        $raceObj = Race::where( 'title_slug', '=', $testSlug );
                    } while( $raceObj->count() > 0 );
                    $titleSlug = $testSlug;
                }  
                
                $newRace = new Race;
                $newRace->title = ucwords($request->title);
                $newRace->title_slug = $titleSlug;
                $newRace->status = 1;
                $newRace->kind_id = $request->kindid;
                $newRace->save();
        
                DB::commit();
                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Race added Successfully';
                return $data;

        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Problem saving data. '.$e->getMessage();
            return $data;
            //$this->error($e->getMessage(), $e->getCode());
        }
    } 
}

?>