<?php 
namespace App\Http\Controllers\Admin\Ad;
use App\Http\Controllers\Controller;
use App\Interfaces\AdInterface;
use App\Http\Requests\AdRequest;
use Illuminate\Http\Request;
use Session;
class AdController extends Controller
{ 
    protected $adInterface;
    public function __construct(AdInterface $adInterface)
    {
        $this->adInterface = $adInterface;
    }

    public function search( Request $req ){
        $data = $this->adInterface->searchAds($req);
        return view('admin.ads.ads.table_data',$data)->render();
    } 

    public function list(){
        $data = $this->adInterface->listAds();
        return view('admin.ads.ads.list', $data);
    } 

    public function viewAd( Request $request ){
        $data = $this->adInterface->viewAd( $request );

        if( $data['result'] == null )
        {
             return redirect('/admin/listads');
        }
        return view('admin.ads.ads.adsdetail', $data);
    }

    public function create(AdRequest $request){
        return $this->adInterface->createAd( $request );
    }  

    public function update(Request $request){
        $data = $this->adInterface->updateAd( $request );
        if( $data['code'] == 201 ) {
            Session::flash('message', "Data Updated Successfuly");
        } else if( $data['code'] == 422 ){
            return redirect('/admin/adsdetail/'.$request->adId)
                        ->withErrors($data['msg']);
        } else if( $data['code'] == 304 ){
            Session::flash('message', "You Have Not Changed Any Data, So There Is No Need To Execute Update Request.");
        }

        return redirect('/admin/adsdetail/'.$request->adId)
                        ->withInput();
    }  

    public function delete(Request $request){
        $data = $this->adInterface->deleteAd( $request );
        if( $data['code'] == 201 ) {
            Session::flash('message', "Ad deleted Successfuly");
        } else if( $data['code'] == 422 ){
            return redirect('/admin/listads')
                        ->withErrors($data['msg']);
        } else if( $data['code'] == 304 ){
            Session::flash('message', "You Have Not Changed Any Data, So There Is No Need To Execute Update Request.");
        }

        return redirect('/admin/listads')
                        ->withInput();
    }  

    public function deleteImage( Request $request ){
        $data = $this->adInterface->deleteImage( $request );
        return $data;
    }
}

