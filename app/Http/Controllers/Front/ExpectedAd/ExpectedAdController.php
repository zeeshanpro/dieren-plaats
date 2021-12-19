<?php

namespace App\Http\Controllers\Front\ExpectedAd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\ExpectedBabieInterface;
use App\Http\Requests\Front\ExpectedBabieRequest;

class ExpectedAdController extends Controller
{
    protected $expected_babies_subscribeInterface;
    public function __construct(ExpectedBabieInterface $expected_babies_subscribeInterface)
    {
        $this->expected_babies_subscribeInterface = $expected_babies_subscribeInterface;
    }

    public function subscribe( Request $request ){
        $data = $this->expected_babies_subscribeInterface->subscribe( $request );
        return response()->json( $data );
    }

    public function showAll( Request $request ){
        $data = $this->expected_babies_subscribeInterface->showExpectedBabiesWithSearchAndPaginate( $request );
        if( $data['code'] == 201 ){
            return view( 'front.expectedbabies.listeb' , $data );
        } else {
            redirect()->route('listBreeders');
        }
    }

    public function search_expectedbabies( Request $request ){
        $data = $this->expected_babies_subscribeInterface->showExpectedBabiesWithSearchAndPaginate( $request );
        return view('front.layout.components.ebListBridge',$data)->render(); 
    }

    public function create( Request $expectedBabieRequest ){
        $data = $this->expected_babies_subscribeInterface->create_expected_babie( $expectedBabieRequest );
        return $data; 
    }

    public function update( Request $expectedBabieRequest ){
        $data = $this->expected_babies_subscribeInterface->update_expected_babie( $expectedBabieRequest );
        return $data; 
    }

    public function delete( Request $expectedBabieRequest ){
        $data = $this->expected_babies_subscribeInterface->delete_expected_babie( $expectedBabieRequest );
        return $data; 
    }
}
