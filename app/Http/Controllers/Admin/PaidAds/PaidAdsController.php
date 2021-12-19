<?php

namespace App\Http\Controllers\Admin\PaidAds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AdInterface;

class PaidAdsController extends Controller
{
    protected $adInterface;
    public function __construct(AdInterface $adInterface)
    {
        $this->adInterface = $adInterface;
    }

    public function list(){
        $data = $this->adInterface->listPaidAds();
        return view('admin.featuredads.list', $data);
    } 

    public function search( Request $request ){
        $data = $this->adInterface->searchPaidAds( $request );
        return view('admin.featuredads.list', $data);
    } 
}
