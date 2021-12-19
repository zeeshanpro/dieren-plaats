<?php 
namespace App\Interfaces\Front;
use Illuminate\Http\Request;
use App\Http\Requests\Front\AdRequest;

interface AdInterface 
{ 

    /*
    to create the User 
    @method POST api/user/create
    */
    public function listAds();
    public function searchAds(Request $request);
    public function viewAd(Request $request);
    public function createAd(AdRequest $request);
    public function updateAd(Request $request);
    public function deleteImage(Request $request);
    public function saveAttributesOptions(Request $request);
    public function listSearchAdsWithPaginateAndSearch( Request $request);
    public function playPause(Request $request);
    public function publishAd( Request $request );
}

?>