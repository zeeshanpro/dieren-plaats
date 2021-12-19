<?php 
namespace App\Http\Controllers\Admin\ExpectedBabie;
use App\Http\Controllers\Controller;
use App\Interfaces\ExpectedBabieInterface;
use App\Http\Requests\ExpectedBabieRequest;
use Illuminate\Http\Request;
use Session;

class ExpectedBabieController extends Controller
{ 
    protected $expected_babieInterface;
    public function __construct(ExpectedBabieInterface $expected_babieInterface)
    {
        $this->expected_babieInterface = $expected_babieInterface;
    }

    public function create(ExpectedBabieRequest $request){
        return $this->expected_babieInterface->createExpected_babie( $request );
    }  

    public function list(){
        $data = $this->expected_babieInterface->list_expected_babie();
        return view('admin.ads.expectedAds.list' , $data);
    } 

    public function search( Request $req ){
        $data = $this->expected_babieInterface->search_expected_babie($req);
        return view('admin.ads.expectedAds.table_data',$data)->render();
    } 

    public function view( Request $req ){
        $data = $this->expected_babieInterface->view($req);
        return view('admin.ads.expectedAds.adsdetail', $data);
    } 

    public function update( Request $req ){
        $data = $this->expected_babieInterface->update( $req );
        if( $data['code'] == 201 )
        {
            Session::flash('message', "Data Updated Successfuly");
        } else if( $data['code'] == 422 ){
            return redirect('/admin/expectedad_detail/'.$req->adId)
                        ->withErrors($data['msg']);
        }

        return redirect('/admin/expectedad_detail/'.$req->adId)
                        ->withInput();
    } 
}

?>