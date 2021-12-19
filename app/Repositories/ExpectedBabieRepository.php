<?php 
namespace App\Repositories;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ExpectedBabieInterface;
use App\Http\Requests\ExpectedBabieRequest;
use App\Models\ExpectedBabie;
use App\Models\Race;
use App\Models\Kind;
use App\Models\AdAttribute;
use Illuminate\Support\Facades\Validator;

class ExpectedBabieRepository implements ExpectedBabieInterface
{ 
    public function list_expected_babie(  ){
        $data['result'] = ExpectedBabie::
                                with(['expected_babieKind','expected_babieRace','expected_babieUser'])
                                ->get();
        $data['code'] = 200;
        
        return $data;
    }

    public function search_expected_babie(Request $request){
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output="";
            $data['result'] = ExpectedBabie::where('title', 'like', '%'.$query.'%')
                                ->orWhere('father', 'like', '%'.$query.'%')
                                ->orWhere('mother', 'like', '%'.$query.'%')
                                ->orWhere('expected_at', 'like', '%'.$query.'%')
                                ->with(['expected_babieKind','expected_babieRace','expected_babieUser'])
                                ->paginate(REC_PER_PAGE);
            $data['code'] = 200; 
            return $data;
        }
    }

    public function view( Request $request ){
        $data['result'] = ExpectedBabie::where('id', '=', $request->adId )  
                                ->with(['expected_babieKind','expected_babieRace','expected_babieUser.Breeder'])
                                ->first();

        $data['races'] =  Race::all();
        $data['kinds'] =  Kind::all();
        $data['attributes'] =  AdAttribute::with('ad_attributeAdAttributeOptions')->get();
        $data['code'] = 200;
        
        return $data;
    }

    public function create_expected_babie( ExpectedBabieRequest $request ){
        
        DB::beginTransaction();   
        try { 
                $newExpectedBabie = new ExpectedBabie;
                $newExpectedBabie->title = $request->title;
                $newExpectedBabie->expected_at = $request->expected_at;
                $newExpectedBabie->desc = $request->desc;
                $newExpectedBabie->father = $request->father;
                $newExpectedBabie->mother = $request->mother;
                $newExpectedBabie->father_pic = $request->father_pic;
                $newExpectedBabie->mother_pic = $request->mother_pic;
                $newExpectedBabie->race_id = $request->race_id;
                $newExpectedBabie->kind_id = $request->kind_id;
                $newExpectedBabie->user_id = $request->user_id;
                $newExpectedBabie->save();
        
                DB::commit();
                return $this->success("Expected Babie created", [
                    'order_id'  => $newExpectedBabie->id,
                    'error' => false,
                    'request' => $request->all(),
                ] , 201 );

        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage(), $e->getCode());
        }
    } 

    public function update( Request $request ){
        $data = array();

        $validator = Validator::make($request->all(), 
                [ 
                    'adId' => 'required|numeric',
                    'title' => 'required',
                    'desc' => 'required',
                    'raceid' => 'required|numeric',
                    'kindid' => 'required|numeric'
                ]); 

        if ($validator->fails()) { 
            // to review Sunny
            if( $request->is('api/*')){
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = $validator->errors()->first();
            }

            $validator->validate();
        }
        DB::beginTransaction();   
        try {
                $adRec = ExpectedBabie::find( $request->adId );
                $adRec->title = $request->title;
                $adRec->desc = $request->desc;
                $adRec->race_id = $request->raceid;
                $adRec->kind_id = $request->kindid;
                $adRec->save();
                
                DB::commit();
                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Ad update successful';
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return $data;
        }  
    }
}
