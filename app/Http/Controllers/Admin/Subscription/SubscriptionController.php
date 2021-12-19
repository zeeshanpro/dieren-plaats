<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UserInterface;

class SubscriptionController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function list( Request $request ){
        $data = $this->userInterface->listSubscriptions();
        return view('admin.subscription.listsubscription', $data );
    }

    public function search( Request $req ){
        $data = $this->userInterface->searchSubscriptions($req);
        return view('admin.subscription.table_data',$data)->render();
    } 
}
