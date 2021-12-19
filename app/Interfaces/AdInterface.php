<?php 
namespace App\Interfaces;
use App\Http\Requests\AdRequest;
use Illuminate\Http\Request;

interface AdInterface 
{ 

    /*
    to create the Ad 
    @method POST api/ad/create
    */
    public function createAd(AdRequest $request);
    public function viewAd(Request $request);
    public function listAds();
    public function searchAds(Request $request);
    public function updateAd(Request $request);
    public function deleteImage(Request $request);
    public function searchPaidAds(Request $request);
    public function listPaidAds();
}
